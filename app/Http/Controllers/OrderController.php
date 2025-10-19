<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() // atau method yang menampilkan welcome
    {
        $orders = Order::orderBy('id', 'desc')->get();
        $grandTotal = $orders->sum('total_price'); // Hitung grand total

        return view('welcome', compact('orders', 'grandTotal'));
    }

    public function store(Request $request)
    {    
        // Validasi manual untuk quantity
        if (empty($request->quantity) || $request->quantity < 1) {
            return redirect('/')->with('error', 'Maaf, harap masukkan jumlah pesanan terlebih dahulu sebelum menscan QR nya. Silahkan coba lagi!');
        }

        // Validasi input
        $request->validate([
            'id_item' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        // Cek apakah item valid
        $item = Item::where('uuid', $request->id_item)->first();
        if (!$item) {
            return redirect('/')->with('notNull', 'Item tidak terdaftar');
        }

        $price = $item->price;
        $qty = $request->quantity;
        $total_price = $price * $qty;

        // Cek duplikasi item
        $existingOrder = Order::where('id_item', $request->id_item)->first();

        // Update quantity jika item sudah ada
        if ($existingOrder) {
            $existingOrder->quantity += $qty;
            $existingOrder->total_price = $existingOrder->quantity * $price;
            $existingOrder->save();
        } else {
            // Simpan order baru
            Order::create([
                'id_item' => $request->id_item,
                'quantity' => $request->quantity,
                'date' => date('Y-m-d'),
                'total_price' => $total_price
            ]);
        }

        return redirect('/')->with('success', 'Item berhasil ditambahkan');
    }

    // Proses pembayaran
    public function processPayment(Request $request)
    {
        $request->validate([
            'payment' => 'required|numeric|min:0'
        ]);

        // Ambil semua order
        $orders = Order::all();
        $grandTotal = $orders->sum('total_price');

        // Validasi pembayaran
        if ($request->payment < $grandTotal) {
            return redirect('/')->with('error', 'Uang pembayaran tidak mencukupi');
        }

        // Simpan ke session untuk struk
        session([
            'payment' => $request->payment,
            'grand_total' => $grandTotal,
            'change' => $request->payment - $grandTotal,
            'orders' => $orders // simpan data orders untuk struk
        ]);

        // Redirect ke halaman invoice/cetak
        return redirect()->route('order.print');
    }

    public function reset()
    {
        Order::truncate();

        return redirect('/')->with('reset', 'Silahkan masukan pesanan kembali');
    }

    public function print()
    {
        // Ambil data dari session
        $payment = session('payment');
        $grandTotal = session('grand_total');
        $change = session('change');
        $orders = session('orders');

        if (!$payment) {
            return redirect('/')->with('error', 'Tidak ada data pembayaran');
        }

        // Tampilkan halaman invoice
        return view('invoice', compact('payment', 'grandTotal', 'change', 'orders'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'orders' => Order::orderBy('id', 'desc')->get()
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_item'  => 'required',
            'quantity' => 'required|integer|min:1',
            'payment'  => 'required|numeric|min:0',
        ]);

        // Cek apakah item valid
        $item = Item::where('uuid', $request->id_item)->first();
        if (!$item) {
            return redirect('/')->with('notNull', 'Item tidak terdaftar');
        }

        $price = $item->price;
        $qty = $request->quantity;
        $total_price = $price * $qty;

        // Hitung total pesanan yang sudah ada
        $existingOrders = Order::all();
        $grandTotal = $existingOrders->sum('total_price') + $total_price;

        // Cek apakah uang cukup
        if ($request->payment < $grandTotal) {
            return redirect('/')->with('failed', 'Uang pembayaran tidak mencukupi');
        }

        // Cek duplikasi item
        $cek = Order::where([
            'id_item'     => $request->id_item,
            'quantity'    => $request->quantity,
            'date'        => date('Y-m-d'),
            'total_price' => $total_price
        ])->first();

        if ($cek) {
            return redirect('/')->with('failed', 'Item sudah dimasukkan');
        }

        // Simpan order
        Order::create([
            'id_item'  => $request->id_item,
            'quantity' => $request->quantity,
            'date'     => date('Y-m-d'),
            'total_price' => $total_price
        ]);

        // Simpan nominal pembayaran terakhir ke session (buat struk)
        session(['payment' => $request->payment]);

        return redirect('/')->with('success', 'Item berhasil ditambahkan');
    }


    public function reset()
    {
        Order::truncate();

        return redirect('/')->with('reset', 'Silahkan masukan pesanan kembali');
    }

    public function print()
    {
        return view('invoice', [
            'orders' => Order::orderBy('id', 'desc')->get()
        ]);
    }
}

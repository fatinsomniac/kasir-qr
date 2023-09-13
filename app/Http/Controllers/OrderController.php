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
        // Cek data null
        $id_item = $request->id_item;
        $cekNull = Item::where([
            'uuid' => $id_item
        ])->first();

        if (!$cekNull) {
            return redirect('/')->with('notNull', 'Item tidak terdaftar');
        }

        $price = $cekNull->price;
        $qty = $request->quantity ?? 1;
        $total_price = $price * $qty;

        // Cek data
        $cek = Order::where([
            'id_item'     => $request->id_item,
            'quantity'    => $request->quantity ?? 1,
            'date'        => date('Y-m-d'),
            'total_price' => $total_price
        ])->first();

        if ($cek) {
            return redirect('/')->with('failed', 'Item sudah dimasukan');
        }

        Order::create([
            'id_item'  => $request->id_item,
            'quantity' => $request->quantity ?? 1,
            'date'     => date('Y-m-d'),
            'total_price' => $total_price
        ]);

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

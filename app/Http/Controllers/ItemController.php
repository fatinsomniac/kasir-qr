<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ItemController extends Controller
{
    public function index()
    {
        return view('items');
    }

    public function store(Request $request)
    {
        // generate unique uuid
        $uuid = Str::uuid();

        // Create item
        $item = Item::create([
            'uuid' => $uuid,
            'item_name' => $request->item_name,
            'price' => $request->price,
            'qrcode_path' => null,
        ]);

        // Generate QR Code dan simpan ke storage
        $filePath = storage_path('app/public/items-qr/' . $uuid . '.svg');

        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0755, true);
        }

        QrCode::generate($uuid, $filePath);

        $item->update(['qrcode_path' => 'items-qr/' . $uuid . '.svg']);

        return redirect()->route('items.index')->with('success', 'Item berhasil ditambahkan!');
    }
}

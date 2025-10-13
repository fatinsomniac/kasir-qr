<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items', compact('items'));
    }

    public function store(Request $request)
    {
        // ✅ Validasi manual agar pesan error bisa dikirim ke alert
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|unique:items,item_name',
            'price' => 'required|numeric|min:0',
        ], [
            'item_name.required' => 'Nama item wajib diisi.',
            'item_name.unique' => 'Nama item telah terdaftar.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh negatif.',
        ]);

        if ($validator->fails()) {
            // Gabungkan semua pesan error menjadi satu teks
            $errorMessages = implode(' | ', $validator->errors()->all());
            return redirect()->route('items.index')->with('error', $errorMessages);
        }

        try {
            // Generate unique uuid
            $uuid = Str::uuid();

            // Simpan item baru (qrcode sementara null)
            $item = Item::create([
                'uuid' => $uuid,
                'item_name' => $request->item_name,
                'price' => $request->price,
                'qrcode_path' => null,
            ]);

            // Path untuk menyimpan QR code
            $filePath = storage_path('app/public/items-qr/' . $uuid . '.svg');

            // Pastikan direktori tersedia
            if (!file_exists(dirname($filePath))) {
                mkdir(dirname($filePath), 0755, true);
            }

            // Generate QR Code
            QrCode::generate($uuid, $filePath);

            // Update path QR ke database
            $item->update(['qrcode_path' => 'items-qr/' . $uuid . '.svg']);

            return redirect()->route('items.index')->with('success', 'Item berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('items.index')->with('error', 'Gagal menambahkan item. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $item = Item::findOrFail($id);
        $item->update([
            'item_name' => $request->item_name,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Item berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $item = Item::findOrFail($id);

            // Hapus file QR code jika ada
            if ($item->qrcode_path && file_exists(storage_path('app/public/' . $item->qrcode_path))) {
                unlink(storage_path('app/public/' . $item->qrcode_path));
            }

            $item->delete();

            return redirect()->route('items.index')->with('success', 'Item berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('items.index')
                ->with('error', 'Gagal menghapus item. Silakan coba lagi.');
        }
    }

    public function showQr($uuid)
    {
        $item = Item::where('uuid', $uuid)->firstOrFail();
        return view('show_qr', compact('item'));
    }
}

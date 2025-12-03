<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
// use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicOrderController extends Controller
{
    public function index()
    {
        // Ambil semua menu untuk dropdown
        $products = Menu::all();
        return view('order-form', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:menus,id',
            'products.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // 1. Buat Order Header
            // Buat No Antrian Simple (misal: ORD-timestamp)
            $noAntrian = 'Q-' . time();

            $order = Order::create([
                'nama_pemesan' => $request->nama,
                'no_antrian' => $noAntrian,
                'catatan' => $request->catatan,
                'total_harga' => 0, // Hitung nanti
                'status_pembayaran' => 'belum_bayar',
            ]);

            $grandTotal = 0;
            $waItemsList = "";

            // 2. Loop Items
            foreach ($request->products as $item) {
                $menuDb = Menu::findOrFail($item['id']);
                $subtotal = $menuDb->harga * $item['jumlah'];
                $grandTotal += $subtotal;

                // simpan Order Item
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menuDb->id,
                    'nama_produk_snapshot' => $menuDb->nama_menu,
                    'harga_snapshot' => $menuDb->harga,
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $subtotal,
                ]);

                // Susun string untuk WhatsApp
                // Contoh: - odading (1 x Rp 2.000)
                $waItemsList .= "- {$menuDb->nama_menu} ({$item['jumlah']} x Rp " . number_format($menuDb->harga, 0, ',', '.') . ")\n";
            }

            // Update Total Harga di Header
            $order->update(['total_harga' => $grandTotal]);

            DB::commit(); //simpan semua data

            // 3. Redirect ke WhatsApp
            $totalFormatted = number_format($grandTotal, 0, ',', '.');
            $catatanUser = $order->catatan ? $order->catatan : '-';

            $message = "Halo Cakwe dan Roti Goreng Bantal Jaya Pak Ali, saya ingin memesan:\n\n"
                . "Nama: {$order->nama_pemesan}\n"
                . "No Antrian: {$order->no_antrian}\n"
                . "------------------------------\n"
                . "Pesanan:\n"
                . $waItemsList
                . "------------------------------\n"
                . "Total Harga: Rp {$totalFormatted}\n"
                . "Catatan: {$catatanUser}\n\n"
                . "Mohon info pembayaran via QRIS/Transfer. Terima kasih!";

            // Nomor Admin (Ganti dengan nomor asli, format 628...)
            $waNumber = '6283171772363';

            // Redirect ke API WhatsApp
            return redirect()->away("https://wa.me/{$waNumber}?text=" . urlencode($message));
        } catch (\Exception $e) {
            DB::rollback();
            // Kembalikan ke halaman form dengan pesan error jika gagal
            return back()->with('error', 'Gagal: ' . $e->getMessage())->withInput();
        }
    }
}

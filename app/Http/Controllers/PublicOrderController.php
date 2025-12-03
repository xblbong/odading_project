<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicOrderController extends Controller
{
    public function index()
    {
        // Ambil semua menu untuk dropdown
        $products = Product::all();
        return view('order-form', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
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
                $productDb = Product::find($item['id']);
                $subtotal = $productDb->harga * $item['jumlah'];
                $grandTotal += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productDb->id,
                    'nama_produk_snapshot' => $productDb->nama_menu,
                    'harga_snapshot' => $productDb->harga,
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $subtotal,
                ]);

                // Susun string untuk WhatsApp
                $waItemsList .= "- {$productDb->nama_menu} ({$item['jumlah']} x Rp " . number_format($productDb->harga, 0,',','.') . ")\n";
            }

            // Update Total Harga di Header
            $order->update(['total_harga' => $grandTotal]);

            DB::commit();

            // 3. Redirect ke WhatsApp
            $waNumber = '6285158329255';
            $message = "Halo Cakwe dan Roti Goreng Bantal Jaya Pak Ali, saya ingin memesan:\n\n"
                . "Nama: *{$order->nama_pemesan}*\n"
                . "No Antrian: *{$order->id}*\n" // Pakai ID sebagai antrian harian simplenya
                . "------------------------------\n"
                . "Pesanan:\n" . $waItemsList
                . "------------------------------\n"
                . "Total Harga: *Rp " . number_format($grandTotal, 0,',','.') . "*\n"
                . "Catatan: " . ($order->catatan ?? '-') . "\n\n"
                . "Mohon info pembayaran via QRIS/Transfer. Terima kasih!";

            return redirect()->away("https://wa.me/{$waNumber}?text=".urlencode($message));

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan pesanan.');
        }
    }
}

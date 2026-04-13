<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class PublicOrderController extends Controller
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    public function index()
    {
        $products = Menu::where('is_available', true)->get();
        return view('order-form', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'               => 'required|string',
            'products'           => 'required|array',
            'products.*.id'      => 'required|exists:menus,id',
            'products.*.jumlah'  => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $noAntrian = 'Q-' . time();

            $order = Order::create([
                'nama_pemesan'      => $request->nama,
                'no_antrian'        => $noAntrian,
                'catatan'           => $request->catatan,
                'total_harga'       => 0,
                'status_pembayaran' => 'belum_bayar',
            ]);

            $grandTotal = 0;
            $itemDetails = [];

            foreach ($request->products as $item) {
                $menuDb   = Menu::findOrFail($item['id']);
                $subtotal = $menuDb->harga * $item['jumlah'];
                $grandTotal += $subtotal;

                OrderItem::create([
                    'order_id'             => $order->id,
                    'menu_id'              => $menuDb->id,
                    'nama_produk_snapshot' => $menuDb->nama_menu,
                    'harga_snapshot'       => $menuDb->harga,
                    'jumlah'               => $item['jumlah'],
                    'subtotal'             => $subtotal,
                ]);

                // Format item untuk Midtrans
                $itemDetails[] = [
                    'id'       => (string) $menuDb->id,
                    'price'    => (int) $menuDb->harga,
                    'quantity' => (int) $item['jumlah'],
                    'name'     => substr($menuDb->nama_menu, 0, 50), // Midtrans max 50 char
                ];
            }

            $order->update(['total_harga' => $grandTotal]);

            // Buat transaksi Midtrans Snap
            $params = [
                'transaction_details' => [
                    'order_id'     => (string) $order->id,
                    'gross_amount' => (int) $grandTotal,
                ],
                'item_details'        => $itemDetails,
                'customer_details'    => [
                    'first_name' => $order->nama_pemesan,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            // Simpan snap_token ke database
            $order->update(['snap_token' => $snapToken]);

            DB::commit();

            // Return JSON dengan snap_token & order info
            return response()->json([
                'snap_token' => $snapToken,
                'order_id'   => $order->id,
                'no_antrian' => $order->no_antrian,
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'error' => 'Gagal membuat pesanan: ' . $e->getMessage(),
            ], 500);
        }
    }
}

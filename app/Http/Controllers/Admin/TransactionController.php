<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        // Ambil data order, urutkan dari yang terbaru
        // Kita load relasi 'items' agar bisa ditampilkan di Modal Detail
        $transaksi = Order::with('items')->latest()->paginate(10);

        return view('admin.transaksi.index', compact('transaksi'));
    }

    // Fungsi Konfirmasi Pembayaran
    public function confirmPayment($id)
    {
        $order = Order::findOrFail($id);
        
        // Update status jadi sudah_bayar
        $order->update([
            'status_pembayaran' => 'sudah_bayar'
        ]);

        return back()->with('success', "Pesanan #{$order->no_antrian} berhasil dikonfirmasi LUNAS!");
    }
}

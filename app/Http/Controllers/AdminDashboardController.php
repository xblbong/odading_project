<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Data Transaksi Bulan Ini
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Total Pemasukan (Hanya yang Status = sudah_bayar)
        $incomeThisMonth = Order::where('status_pembayaran', 'sudah_bayar')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('total_harga');

        // Total Order Bulan Ini
        $ordersCountMonth = Order::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        // List Order Terbaru (Pending di atas)
        $orders = Order::with('items.menu')->latest()->paginate(10);

        return view('admin.dashboard', compact('incomeThisMonth', 'ordersCountMonth', 'orders'));
    }

    // Approve Pembayaran
    public function approve($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status_pembayaran' => 'sudah_bayar']);
        return back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}
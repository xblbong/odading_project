<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    /**
     * Webhook: Dipanggil otomatis oleh server Midtrans setelah pembayaran.
     * URL ini harus dikonfigurasi di Dashboard Midtrans → Settings → Payment Notification URL
     */
    public function notification(Request $request)
    {
        try {
            $notification = new Notification();

            $transactionStatus = $notification->transaction_status;
            $paymentType       = $notification->payment_type;
            $orderId           = $notification->order_id;
            $fraudStatus       = $notification->fraud_status;

            $order = Order::findOrFail($orderId);

            // Tentukan status pembayaran berdasarkan respons Midtrans
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    $order->update(['status_pembayaran' => 'belum_bayar']);
                } elseif ($fraudStatus == 'accept') {
                    $order->update([
                        'status_pembayaran' => 'sudah_bayar',
                        'payment_type'      => $paymentType,
                    ]);
                }
            } elseif ($transactionStatus == 'settlement') {
                $order->update([
                    'status_pembayaran' => 'sudah_bayar',
                    'payment_type'      => $paymentType,
                ]);
            } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                $order->update(['status_pembayaran' => 'belum_bayar']);
            } elseif ($transactionStatus == 'pending') {
                $order->update(['status_pembayaran' => 'belum_bayar']);
            }

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Halaman sukses setelah pembayaran selesai.
     */
    public function success($orderId)
    {
        $order = Order::with('items.menu')->findOrFail($orderId);
        return view('payment.success', compact('order'));
    }
}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil – Pak Ali</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f0fff4 0%, #dcfce7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: 'Inter', sans-serif;
        }

        .card {
            background: #fff;
            border-radius: 28px;
            box-shadow: 0 30px 60px rgba(0,128,60,0.12);
            max-width: 560px;
            width: 100%;
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #16a34a, #22c55e);
            color: white;
            text-align: center;
            padding: 40px 30px 36px;
            position: relative;
        }
        .header .check-circle {
            width: 72px;
            height: 72px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 2.2rem;
            animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes popIn {
            0%   { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .header h1 { font-size: 1.6rem; font-weight: 800; margin-bottom: 6px; }
        .header p  { opacity: 0.9; font-size: 0.95rem; }

        .antrian-badge {
            background: rgba(255,255,255,0.18);
            border: 1.5px solid rgba(255,255,255,0.4);
            border-radius: 12px;
            padding: 14px 24px;
            margin-top: 20px;
            display: inline-block;
        }
        .antrian-badge .label { font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.85; }
        .antrian-badge .value { font-size: 2rem; font-weight: 800; letter-spacing: 2px; }

        .body { padding: 32px; }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.92rem;
        }
        .info-row .key   { color: #888; }
        .info-row .val   { font-weight: 700; color: #222; }

        .items-title {
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #999;
            margin: 22px 0 12px;
        }

        .item-line {
            display: flex;
            justify-content: space-between;
            font-size: 0.92rem;
            padding: 8px 0;
            border-bottom: 1px dashed #f0f0f0;
            color: #444;
        }
        .item-line:last-child { border-bottom: none; }
        .item-line .name { flex: 1; }
        .item-line .qty  { color: #888; margin: 0 14px; white-space: nowrap; }
        .item-line .sub  { font-weight: 700; color: #222; white-space: nowrap; }

        .total-row {
            margin-top: 18px;
            background: #f9fafb;
            border-radius: 14px;
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .total-row .label { font-weight: 700; color: #333; }
        .total-row .amount { font-size: 1.5rem; font-weight: 800; color: #16a34a; }

        .note-box {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 0.88rem;
            color: #92400e;
            margin-top: 22px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }
        .note-box .icon { font-size: 1.1rem; flex-shrink: 0; }

        .btn-back {
            display: block;
            width: 100%;
            margin-top: 24px;
            padding: 16px;
            background: linear-gradient(135deg, #16a34a, #22c55e);
            color: white;
            font-size: 1rem;
            font-weight: 700;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: 0.2s;
            box-shadow: 0 6px 18px rgba(22,163,74,0.3);
        }
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(22,163,74,0.4);
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="header">
            <div class="check-circle">✅</div>
            <h1>Pembayaran Berhasil!</h1>
            <p>Pesanan kamu sedang diproses, {{ $order->nama_pemesan }}.</p>
            <div class="antrian-badge">
                <div class="label">No. Antrian Kamu</div>
                <div class="value">{{ $order->no_antrian }}</div>
            </div>
        </div>

        <div class="body">
            <div class="info-row">
                <span class="key">Nama Pemesan</span>
                <span class="val">{{ $order->nama_pemesan }}</span>
            </div>
            <div class="info-row">
                <span class="key">Waktu Pesan</span>
                <span class="val">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
            </div>
            @if($order->payment_type)
            <div class="info-row">
                <span class="key">Metode Bayar</span>
                <span class="val">{{ str_replace('_', ' ', strtoupper($order->payment_type)) }}</span>
            </div>
            @endif

            <div class="items-title">Detail Pesanan</div>

            @foreach($order->items as $item)
            <div class="item-line">
                <span class="name">{{ $item->nama_produk_snapshot }}</span>
                <span class="qty">x{{ $item->jumlah }}</span>
                <span class="sub">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
            </div>
            @endforeach

            @if($order->catatan)
            <div class="info-row" style="margin-top: 4px;">
                <span class="key">Catatan</span>
                <span class="val" style="text-align:right; max-width:60%;">{{ $order->catatan }}</span>
            </div>
            @endif

            <div class="total-row">
                <span class="label">Total Dibayar</span>
                <span class="amount">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
            </div>

            <div class="note-box">
                <span class="icon">📋</span>
                <span>Tunjukkan <strong>No. Antrian {{ $order->no_antrian }}</strong> ke kasir saat mengambil pesanan. Terima kasih telah memesan!</span>
            </div>

            <a href="{{ route('order.index') }}" class="btn-back">
                🛍️ Pesan Lagi
            </a>
        </div>
    </div>
</body>

</html>

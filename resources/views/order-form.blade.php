<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Pemesanan - Pak Ali</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    {{-- Midtrans Snap.js --}}
    <script src="{{ config('midtrans.snap_url') }}"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        const menuData = @json($products);
    </script>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #fff8ee 0%, #ffe8c8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: 'Inter', sans-serif;
        }

        .card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 28px;
            box-shadow: 0 30px 60px rgba(182, 79, 11, 0.15);
            max-width: 820px;
            width: 100%;
            overflow: hidden;
            border: 1px solid rgba(255, 146, 0, 0.12);
        }

        .header {
            background: linear-gradient(135deg, #ff5e00, #ff9200);
            color: white;
            text-align: center;
            padding: 36px 30px;
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: '';
            position: absolute;
            top: -50px; right: -50px;
            width: 180px; height: 180px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }
        .header h1 { font-size: 2rem; font-weight: 800; margin-bottom: 6px; position: relative; }
        .header p  { font-size: 0.95rem; opacity: 0.9; position: relative; }

        .body { padding: 36px; }

        .form-label {
            display: block;
            font-weight: 700;
            color: #682907;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .input-style {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            background: #fff;
            transition: border-color 0.2s;
        }
        .input-style:focus {
            border-color: #ff8c00;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255,140,0,0.1);
        }

        .item-row {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            background: #fafafa;
            padding: 14px;
            border-radius: 14px;
            border: 1px solid #f0f0f0;
            margin-bottom: 10px;
            transition: box-shadow 0.2s;
        }
        .item-row:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
        .item-row .flex-1 { flex: 1; }
        .item-row .qty-wrap { width: 80px; }
        .item-row .sub-wrap { width: 110px; text-align: right; padding-top: 14px; font-weight: 700; color: #555; font-size: 0.88rem; }
        .item-row .del-wrap { padding-top: 10px; }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            background: #fff3e0;
            color: #e65c00;
            border: 1.5px dashed #ffb74d;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.88rem;
            cursor: pointer;
            transition: 0.2s;
            margin-bottom: 20px;
        }
        .btn-add:hover { background: #ffe0b2; border-color: #ff8c00; }

        .total-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #fff8ee, #ffe8c8);
            padding: 18px 22px;
            border-radius: 16px;
            border: 1px solid #ffd180;
            margin-bottom: 22px;
        }
        .total-box .label { font-size: 1rem; font-weight: 700; color: #682907; }
        .total-box .amount { font-size: 1.6rem; font-weight: 800; color: #ff5e00; }

        .btn-pay {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #ff8c00, #ff5e00);
            color: white;
            font-size: 1.1rem;
            font-weight: 800;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: 0.25s;
            box-shadow: 0 8px 20px rgba(255,100,0,0.3);
        }
        .btn-pay:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(255,100,0,0.4);
        }
        .btn-pay:disabled {
            opacity: 0.65;
            cursor: not-allowed;
            transform: none;
        }

        .alert-error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 14px 18px;
            border-radius: 10px;
            border: 1px solid #fca5a5;
            margin-bottom: 18px;
            font-size: 0.9rem;
        }

        .spinner {
            width: 20px; height: 20px;
            border: 3px solid rgba(255,255,255,0.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            display: none;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        textarea.input-style { resize: vertical; min-height: 88px; }
    </style>
</head>

<body>
    <div class="card">
        <div class="header">
            <h1>🍢 Form Pemesanan</h1>
            <p>Cakwe & Roti Goreng Bantal Jaya Pak Ali</p>
        </div>

        <div class="body">

            {{-- Alert Error --}}
            <div id="alert-error" class="alert-error" style="display:none;"></div>

            @if ($errors->any())
                <div class="alert-error">
                    @foreach ($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form id="orderForm">
                @csrf

                {{-- Nama Pemesan --}}
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Nama Pemesan</label>
                    <input type="text" name="nama" id="nama" class="input-style"
                        required placeholder="Masukkan nama kamu..." autocomplete="off">
                </div>

                {{-- Daftar Item --}}
                <div style="margin-bottom: 6px;">
                    <label class="form-label">Item Pesanan</label>
                </div>
                <div id="items-container"></div>

                <button type="button" class="btn-add" onclick="addItem()">
                    <i class="fa-solid fa-plus"></i> Tambah Menu Lain
                </button>

                {{-- Total --}}
                <div class="total-box">
                    <span class="label">Total Pembayaran</span>
                    <span class="amount" id="grand-total">Rp 0</span>
                </div>

                {{-- Catatan --}}
                <div style="margin-bottom: 24px;">
                    <label class="form-label">Catatan Tambahan <span style="font-weight:400;color:#999;">(opsional)</span></label>
                    <textarea name="catatan" id="catatan" class="input-style"
                        placeholder="Cth: Sambalnya dipisah ya..."></textarea>
                </div>

                {{-- Tombol Bayar --}}
                <button type="submit" class="btn-pay" id="btn-pay">
                    <div class="spinner" id="spinner"></div>
                    <i class="fa-solid fa-credit-card" id="btn-icon"></i>
                    <span id="btn-text">Bayar Sekarang</span>
                </button>
            </form>
        </div>
    </div>

    <script>
        const formatRupiah = (num) => 'Rp ' + Number(num).toLocaleString('id-ID');
        let itemIndex = 0;

        function addItem() {
            const container = document.getElementById('items-container');

            let options = '<option value="" data-harga="0">-- Pilih Menu --</option>';
            menuData.forEach(prod => {
                options += `<option value="${prod.id}" data-harga="${prod.harga}">${prod.nama_menu} – ${formatRupiah(prod.harga)}</option>`;
            });

            const row = document.createElement('div');
            row.className = 'item-row';
            row.innerHTML = `
                <div class="flex-1">
                    <select name="products[${itemIndex}][id]" class="input-style product-select"
                        onchange="calculateTotal()" required>
                        ${options}
                    </select>
                </div>
                <div class="qty-wrap">
                    <input type="number" name="products[${itemIndex}][jumlah]"
                        value="1" min="1" class="input-style qty-input text-center"
                        oninput="calculateTotal()" required>
                </div>
                <div class="sub-wrap subtotal-display">Rp 0</div>
                <div class="del-wrap">
                    <button type="button"
                        onclick="this.closest('.item-row').remove(); calculateTotal()"
                        style="background:none;border:none;color:#e74c3c;cursor:pointer;font-size:1.1rem;padding:4px 6px;"
                        title="Hapus item">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            `;
            container.appendChild(row);
            itemIndex++;
            calculateTotal();
        }

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('#items-container .item-row').forEach(row => {
                const select   = row.querySelector('.product-select');
                const qty      = parseInt(row.querySelector('.qty-input').value) || 0;
                const harga    = parseInt(select.options[select.selectedIndex]?.getAttribute('data-harga')) || 0;
                const subtotal = harga * qty;
                row.querySelector('.subtotal-display').innerText = formatRupiah(subtotal);
                total += subtotal;
            });
            document.getElementById('grand-total').innerText = formatRupiah(total);
        }

        // Saat form di-submit → AJAX ke backend → buka Midtrans Snap
        document.getElementById('orderForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const btn     = document.getElementById('btn-pay');
            const spinner = document.getElementById('spinner');
            const icon    = document.getElementById('btn-icon');
            const text    = document.getElementById('btn-text');
            const alert   = document.getElementById('alert-error');

            // Validasi minimal 1 item dengan menu dipilih
            const selects = document.querySelectorAll('.product-select');
            let valid = false;
            selects.forEach(s => { if (s.value) valid = true; });
            if (!valid) {
                alert.style.display = 'block';
                alert.textContent   = 'Pilih minimal satu menu terlebih dahulu.';
                return;
            }

            alert.style.display = 'none';
            btn.disabled        = true;
            spinner.style.display = 'block';
            icon.style.display  = 'none';
            text.textContent    = 'Memproses...';

            const formData = new FormData(this);

            try {
                const response = await fetch('{{ route("order.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const data = await response.json();

                if (!response.ok || data.error) {
                    throw new Error(data.error || 'Terjadi kesalahan pada server.');
                }

                // Buka Midtrans Snap popup
                window.snap.pay(data.snap_token, {
                    onSuccess: function (result) {
                        window.location.href = `/payment/success/${data.order_id}`;
                    },
                    onPending: function (result) {
                        window.location.href = `/payment/success/${data.order_id}`;
                    },
                    onError: function (result) {
                        alert.style.display = 'block';
                        alert.textContent   = 'Pembayaran gagal. Silakan coba lagi.';
                        resetBtn();
                    },
                    onClose: function () {
                        // User tutup popup tanpa bayar
                        resetBtn();
                    }
                });

            } catch (err) {
                alert.style.display = 'block';
                alert.textContent   = err.message;
                resetBtn();
            }
        });

        function resetBtn() {
            const btn     = document.getElementById('btn-pay');
            const spinner = document.getElementById('spinner');
            const icon    = document.getElementById('btn-icon');
            const text    = document.getElementById('btn-text');
            btn.disabled        = false;
            spinner.style.display = 'none';
            icon.style.display  = '';
            text.textContent    = 'Bayar Sekarang';
        }

        document.addEventListener('DOMContentLoaded', () => addItem());
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Jaya Pak Ali</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Pass data produk ke JS -->
    <script>
        const menuData = @json($products);
    </script>

    <style>
        /* Tetap gunakan style glassmorphism kamu */
        body {
            min-height: 100vh;
            background: #fdf6e3;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: sans-serif;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 28px;
            box-shadow: 0 25px 50px rgba(182, 79, 11, 0.2);
            max-width: 800px;
            width: 100%;
            overflow: hidden;
            border: 1px solid rgba(255, 146, 0, 0.15);
        }

        .header {
            background: linear-gradient(135deg, #ff6600, #ff8c00);
            color: white;
            text-align: center;
            padding: 30px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #ff8c00, #ff6600);
            color: white;
            font-weight: bold;
            padding: 15px;
            width: 100%;
            border-radius: 15px;
            transition: 0.3s;
        }

        .btn-submit:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(255, 140, 0, 0.3);
        }

        .input-style {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 12px;
            background: #fff;
        }

        .input-style:focus {
            border-color: #ff8c00;
            outline: none;
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="header">
            <h1 class="text-3xl font-bold mb-2">Form Pemesanan</h1>
            <p>Pesan banyak menu sekaligus!</p>
        </div>

        <div class="p-8">
            <!-- Cek Error Session -->
            @if (session('error'))
                <div
                    style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; margin-bottom: 1rem; border-radius: 0.5rem; border: 1px solid #fca5a5;">
                    <strong>Terjadi Kesalahan!</strong><br>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Cek Error Validasi -->
            @if ($errors->any())
                <div
                    style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; margin-bottom: 1rem; border-radius: 0.5rem;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('order.store') }}" method="POST" id="orderForm">
                @csrf

                <!-- Nama -->
                <div class="mb-6">
                    <label class="block text-[#682907] font-bold mb-2">Nama Pemesan</label>
                    <input type="text" name="nama" class="input-style" required placeholder="Nama Anda...">
                </div>

                <!-- Container Item Pesanan -->
                <div id="items-container" class="space-y-4 mb-6">
                    <!-- Item Row Default (Akan dikontrol JS) -->
                </div>

                <!-- Tombol Tambah Menu -->
                <button type="button" onclick="addItem()"
                    class="mb-6 px-4 py-2 bg-orange-100 text-orange-700 rounded-lg text-sm font-bold border border-orange-200 hover:bg-orange-200 transition">
                    + Tambah Menu Lain
                </button>

                <!-- Total -->
                <div
                    class="flex justify-between items-center mb-6 p-4 bg-orange-50 rounded-xl border border-orange-100">
                    <span class="text-lg font-bold text-[#682907]">Total Estimasi:</span>
                    <span class="text-2xl font-extrabold text-[#ff6600]" id="grand-total">Rp 0</span>
                </div>

                <!-- Catatan -->
                <div class="mb-6">
                    <label class="block text-[#682907] font-bold mb-2">Catatan Tambahan</label>
                    <textarea name="catatan" class="input-style h-24" placeholder="Cth: Sambalnya dipisah ya..."></textarea>
                </div>

                <button type="submit" class="btn-submit flex items-center justify-center gap-2">
                    <i class="fa-brands fa-whatsapp fa-lg"></i> Pesan & Kirim WA
                </button>
            </form>
        </div>
    </div>

    <script>
        // Fungsi Mata Uang
        const formatRupiah = (num) => 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

        let itemIndex = 0;

        function addItem() {
            const container = document.getElementById('items-container');

            // Buat opsi dropdown dari data menuData (PHP)
            let options = '<option value="" data-harga="0">-- Pilih Menu --</option>';
            menuData.forEach(prod => {
                options +=
                    `<option value="${prod.id}" data-harga="${prod.harga}">${prod.nama_menu} - ${formatRupiah(prod.harga)}</option>`;
            });

            const row = document.createElement('div');
            row.classList.add('flex', 'gap-2', 'items-start', 'bg-gray-50', 'p-3', 'rounded-xl', 'border',
                'border-gray-200');
            row.innerHTML = `
                <div class="flex-1">
                    <select name="products[${itemIndex}][id]" class="input-style product-select" onchange="updatePrice(this)" required>
                        ${options}
                    </select>
                </div>
                <div class="w-20">
                    <input type="number" name="products[${itemIndex}][jumlah]" value="1" min="1" class="input-style text-center qty-input" oninput="calculateTotal()" required>
                </div>
                <div class="w-24 pt-3 text-right font-bold text-gray-600 subtotal-display">
                    Rp 0
                </div>
                <button type="button" onclick="this.parentElement.remove(); calculateTotal()" class="text-red-500 pt-3 px-2 hover:text-red-700">
                    <i class="fa-solid fa-trash"></i>
                </button>
            `;

            container.appendChild(row);
            itemIndex++;
        }

        function updatePrice(selectElement) {
            calculateTotal();
        }

        function calculateTotal() {
            let total = 0;
            const rows = document.querySelectorAll('#items-container > div');

            rows.forEach(row => {
                const select = row.querySelector('.product-select');
                const qtyInput = row.querySelector('.qty-input');
                const subtotalDisplay = row.querySelector('.subtotal-display');

                const price = select.options[select.selectedIndex].getAttribute('data-harga') || 0;
                const qty = qtyInput.value || 0;

                const subtotal = price * qty;
                subtotalDisplay.innerText = formatRupiah(subtotal);
                total += subtotal;
            });

            document.getElementById('grand-total').innerText = formatRupiah(total);
        }

        // Tambah 1 baris saat pertama load
        document.addEventListener('DOMContentLoaded', () => {
            addItem();
        });
    </script>
</body>

</html>

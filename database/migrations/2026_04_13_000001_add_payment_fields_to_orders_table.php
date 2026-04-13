<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Token dari Midtrans untuk membuka Snap popup
            $table->string('snap_token')->nullable()->after('catatan');
            // Metode bayar yang dipilih customer (gopay, bank_transfer, credit_card, dll)
            $table->string('payment_type')->nullable()->after('snap_token');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['snap_token', 'payment_type']);
        });
    }
};

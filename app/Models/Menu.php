<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database (opsional jika nama tabelnya jamak 'menus', 
     * tapi bagus untuk memastikan).
     */
    protected $table = 'menus';

    /**
     * Kolom yang boleh diisi secara massal (Mass Assignment).
     * Wajib ada agar fungsi Menu::create() di Controller berjalan.
     */
    protected $fillable = [
        'nama_menu',
        'kategori',
        'harga',
        'deskripsi',
        'foto',
        'is_available', // Untuk status tersedia/habis
    ];

    /**
     * Casting tipe data (agar outputnya sesuai tipe yang diinginkan).
     */
    protected $casts = [
        'harga' => 'integer',
        'is_available' => 'boolean',
    ];
}

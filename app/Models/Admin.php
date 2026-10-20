<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model untuk tabel Admin. Isinya hanya idPengguna yang merujuk ke tabel Pengguna.
class Admin extends Model
{
    protected $table = 'Admin';
    protected $primaryKey = 'idPengguna';

    // idPengguna diisi dari tabel Pengguna, bukan dibuat otomatis di sini
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['idPengguna'];
}

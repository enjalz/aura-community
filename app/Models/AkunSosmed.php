<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model untuk tabel AkunSosmed: akun Instagram atau TikTok milik influencer.
class AkunSosmed extends Model
{
    protected $table = 'AkunSosmed';
    protected $primaryKey = 'idAkun';

    public $timestamps = false;

    protected $fillable = [
        'idPengguna', 'platform', 'username', 'linkProfil', 'jumlahPengikut',
    ];
}

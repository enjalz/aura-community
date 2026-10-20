<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model untuk tabel Influencer: kategori, status verifikasi, dan status blacklist.
class Influencer extends Model
{
    protected $table = 'Influencer';
    protected $primaryKey = 'idPengguna';

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'idPengguna', 'kategori', 'statusVerifikasi',
        'statusBlacklist', 'alasanBlacklist', 'tanggalBlacklist',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model untuk tabel OwnerBrand: data brand milik pengguna berperan Owner Brand.
class OwnerBrand extends Model
{
    protected $table = 'OwnerBrand';
    protected $primaryKey = 'idPengguna';

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['idPengguna', 'namaBrand', 'namaPerusahaan'];
}

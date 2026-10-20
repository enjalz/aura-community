<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

// Model untuk tabel Pengguna. Dipakai Laravel untuk login:
// email dan password dicocokkan dengan baris di tabel ini.
class Pengguna extends Authenticatable
{
    // Nama tabel dan primary key mengikuti skripsi (bukan "users" dan "id")
    protected $table = 'Pengguna';
    protected $primaryKey = 'idPengguna';

    // Tabel Pengguna tidak punya kolom created_at dan updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi lewat Pengguna::create([...])
    protected $fillable = [
        'nama', 'email', 'password', 'noTelepon', 'alamat', 'statusAkun',
    ];

    // Kolom yang disembunyikan saat data diubah menjadi array atau JSON
    protected $hidden = ['password'];

    // Tabel Pengguna tidak punya kolom remember_token (fitur "ingat saya" tidak dipakai)
    protected $rememberTokenName = '';

    // Password otomatis di-hash saat disimpan, jadi tidak perlu memanggil Hash::make manual
    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    // Relasi ke tabel Admin, OwnerBrand, dan Influencer.
    // Satu Pengguna hanya punya satu baris di salah satu dari ketiga tabel itu.
    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'idPengguna', 'idPengguna');
    }

    public function ownerBrand(): HasOne
    {
        return $this->hasOne(OwnerBrand::class, 'idPengguna', 'idPengguna');
    }

    public function influencer(): HasOne
    {
        return $this->hasOne(Influencer::class, 'idPengguna', 'idPengguna');
    }

    // Menentukan peran pengguna dari tabel tempat datanya berada.
    // Hasilnya: 'admin', 'owner_brand', 'influencer', atau null kalau belum masuk ketiganya.
    public function peran(): ?string
    {
        if ($this->admin()->exists()) {
            return 'admin';
        }
        if ($this->ownerBrand()->exists()) {
            return 'owner_brand';
        }
        if ($this->influencer()->exists()) {
            return 'influencer';
        }
        return null;
    }
}

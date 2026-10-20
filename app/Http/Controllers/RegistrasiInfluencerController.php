<?php

namespace App\Http\Controllers;

use App\Models\AkunSosmed;
use App\Models\Influencer;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

// Mengurus registrasi akun Influencer (use case "Registrasi Akun" di skripsi).
class RegistrasiInfluencerController extends Controller
{
    // Pilihan kategori influencer di formulir
    private const KATEGORI = ['Beauty', 'Tech', 'Fashion', 'Food'];

    // Platform media sosial di formulir: kunci field => nama platform di database
    private const PLATFORM = ['instagram' => 'Instagram', 'tiktok' => 'TikTok'];

    // Menampilkan halaman formulir registrasi
    public function tampilkanForm()
    {
        return view('auth.register', [
            'kategori' => self::KATEGORI,
            'platform' => self::PLATFORM,
        ]);
    }

    // Memeriksa data formulir, lalu menyimpannya ke tabel Pengguna, Influencer, dan AkunSosmed
    public function simpan(Request $request)
    {
        // Rapikan input: email huruf kecil, username tanpa spasi dan tanpa tanda @ di depan
        $request->merge([
            'email' => Str::lower(trim((string) $request->input('email'))),
            'instagram_username' => ltrim(trim((string) $request->input('instagram_username')), '@'),
            'tiktok_username' => ltrim(trim((string) $request->input('tiktok_username')), '@'),
        ]);

        // Aturan pengisian setiap kolom
        $aturan = [
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100', Rule::unique('Pengguna', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'noTelepon' => ['required', 'regex:/^[0-9+\-\s]{8,20}$/'],
            'kategori' => ['required', Rule::in(self::KATEGORI)],
            'alamat' => ['required', 'string', 'max:1000'],
        ];

        // Aturan akun media sosial. Satu platform boleh dikosongkan seluruhnya,
        // tetapi kalau salah satu kolomnya diisi, ketiga kolomnya wajib diisi.
        // Kombinasi platform + username juga tidak boleh sudah terdaftar (tabel AkunSosmed).
        foreach (self::PLATFORM as $kunci => $namaPlatform) {
            $aturan[$kunci . '_username'] = [
                'nullable', 'string', 'max:100',
                'required_with:' . $kunci . '_pengikut,' . $kunci . '_link',
                Rule::unique('AkunSosmed', 'username')->where('platform', $namaPlatform),
            ];
            $aturan[$kunci . '_pengikut'] = [
                'nullable', 'integer', 'min:0', 'max:2147483647',
                'required_with:' . $kunci . '_username,' . $kunci . '_link',
            ];
            $aturan[$kunci . '_link'] = [
                'nullable', 'url', 'max:255',
                'required_with:' . $kunci . '_username,' . $kunci . '_pengikut',
            ];
        }

        $pesan = [
            'required' => ':attribute wajib diisi.',
            'required_with' => ':attribute wajib diisi karena data lain pada platform ini sudah diisi.',
            'email' => 'Format email tidak valid.',
            'unique' => ':attribute sudah terdaftar.',
            'min.string' => ':attribute minimal :min karakter.',
            'max.string' => ':attribute maksimal :max karakter.',
            'min.numeric' => ':attribute tidak boleh negatif.',
            'confirmed' => 'Konfirmasi password tidak sama.',
            'in' => 'Pilihan :attribute tidak valid.',
            'integer' => ':attribute harus berupa angka bulat.',
            'url' => ':attribute harus berupa tautan lengkap, contoh https://instagram.com/namaanda.',
            'regex' => 'Format :attribute tidak valid. Gunakan angka saja, 8 sampai 20 digit.',
        ];

        // Nama kolom yang tampil di pesan error
        $nama = [
            'nama' => 'Nama',
            'email' => 'Email',
            'password' => 'Password',
            'noTelepon' => 'No. Telepon',
            'kategori' => 'Kategori',
            'alamat' => 'Alamat',
        ];
        foreach (self::PLATFORM as $kunci => $namaPlatform) {
            $nama[$kunci . '_username'] = 'Username ' . $namaPlatform;
            $nama[$kunci . '_pengikut'] = 'Jumlah pengikut ' . $namaPlatform;
            $nama[$kunci . '_link'] = 'Link profil ' . $namaPlatform;
        }

        $validator = Validator::make($request->all(), $aturan, $pesan, $nama);

        // Aturan tambahan: minimal satu akun media sosial harus diisi (sesuai wireframe)
        $validator->after(function ($validator) use ($request) {
            if (! $request->filled('instagram_username') && ! $request->filled('tiktok_username')) {
                $validator->errors()->add('sosmed', 'Isi minimal satu akun media sosial (Instagram atau TikTok).');
            }
        });

        // Kalau ada yang salah: kembali ke formulir, isian lama tetap terisi, error ditampilkan
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->except('password', 'password_confirmation'));
        }

        $data = $validator->validated();

        // DB::transaction = semua penyimpanan di bawah berhasil bersama-sama atau dibatalkan semuanya,
        // sehingga tidak ada akun "setengah jadi" kalau terjadi error di tengah jalan.
        DB::transaction(function () use ($data) {
            // 1. Data akun masuk ke tabel Pengguna. Password otomatis di-hash oleh model.
            $pengguna = Pengguna::create([
                'nama' => $data['nama'],
                'email' => $data['email'],
                'password' => $data['password'],
                'noTelepon' => $data['noTelepon'],
                'alamat' => $data['alamat'],
                'statusAkun' => 'aktif',
            ]);

            // 2. Akun didaftarkan sebagai Influencer dengan status menunggu verifikasi Admin
            Influencer::create([
                'idPengguna' => $pengguna->idPengguna,
                'kategori' => $data['kategori'],
                'statusVerifikasi' => 'menunggu',
            ]);

            // 3. Setiap platform yang diisi disimpan sebagai satu baris di tabel AkunSosmed
            foreach (self::PLATFORM as $kunci => $namaPlatform) {
                if (! empty($data[$kunci . '_username'])) {
                    AkunSosmed::create([
                        'idPengguna' => $pengguna->idPengguna,
                        'platform' => $namaPlatform,
                        'username' => $data[$kunci . '_username'],
                        'linkProfil' => $data[$kunci . '_link'],
                        'jumlahPengikut' => $data[$kunci . '_pengikut'],
                    ]);
                }
            }
        });

        // Sementara kembali ke halaman registrasi dengan pesan sukses.
        // Di step login, tujuan ini diganti ke halaman login.
        // Setelah registrasi berhasil, arahkan ke halaman login dengan pesan sukses
        return redirect()->route('login')->with(
            'sukses',
            'Registrasi berhasil. Data Anda akan diperiksa dan diverifikasi oleh Admin sebelum akun dapat digunakan.'
        );
    }
}

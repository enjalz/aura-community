<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

// Mengurus login dan logout semua peran (Admin, Owner Brand, Influencer).
class LoginController extends Controller
{
    // Maksimal percobaan login yang gagal per menit untuk satu email dari satu alamat IP
    private const BATAS_PERCOBAAN = 5;

    // Menampilkan halaman login
    public function tampilkanForm()
    {
        return view('auth.login');
    }

    // Memeriksa email dan password, lalu mengarahkan pengguna ke dashboard sesuai perannya
    public function masuk(Request $request)
    {
        $data = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            [
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'password.required' => 'Password wajib diisi.',
            ]
        );

        $email = Str::lower(trim($data['email']));

        // Pembatas percobaan login supaya password tidak bisa ditebak berulang-ulang
        $kunciBatas = 'login:' . $email . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($kunciBatas, self::BATAS_PERCOBAAN)) {
            $detik = RateLimiter::availableIn($kunciBatas);
            return back()
                ->withErrors(['email' => "Terlalu banyak percobaan login. Coba lagi dalam {$detik} detik."])
                ->onlyInput('email');
        }

        // Auth::attempt mencari email di tabel Pengguna lalu mencocokkan password dengan hash-nya
        if (! Auth::attempt(['email' => $email, 'password' => $data['password']])) {
            RateLimiter::hit($kunciBatas, 60);
            // Pesan sengaja sama untuk email salah maupun password salah
            return back()
                ->withErrors(['email' => 'Email atau password salah.'])
                ->onlyInput('email');
        }

        // Password benar, tetapi akun yang nonaktif atau suspended tidak boleh masuk
        if (Auth::user()->statusAkun !== 'aktif') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return back()
                ->withErrors(['email' => 'Akun Anda tidak aktif. Silakan hubungi Admin.'])
                ->onlyInput('email');
        }

        RateLimiter::clear($kunciBatas);

        // Buat ID sesi baru setelah login, mencegah pencurian sesi (session fixation)
        $request->session()->regenerate();

        // /dashboard akan meneruskan ke halaman yang sesuai peran
        return redirect()->route('dashboard');
    }

    // Logout: hapus sesi login lalu kembali ke halaman depan
    public function keluar(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
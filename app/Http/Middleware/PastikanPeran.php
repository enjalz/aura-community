<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

// Penjaga halaman: hanya pengguna dengan peran yang diizinkan yang boleh lewat.
// Contoh pemakaian di route: PastikanPeran::class . ':admin'
class PastikanPeran
{
    public function handle(Request $request, Closure $next, string ...$peranDiizinkan): Response
    {
        $pengguna = $request->user();

        // Akun yang dinonaktifkan atau di-suspend saat sedang login langsung dikeluarkan
        if ($pengguna->statusAkun !== 'aktif') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => 'Akun Anda tidak aktif. Silakan hubungi Admin.',
            ]);
        }

        // Peran ditentukan dari tabel Admin / OwnerBrand / Influencer
        $peran = $pengguna->peran();

        // Peran tidak cocok dengan halaman ini: tampilkan error 403 (dilarang)
        if (! in_array($peran, $peranDiizinkan, true)) {
            abort(403);
        }

        // Simpan peran di request supaya tampilan (sidebar) tidak perlu mengeceknya lagi
        $request->attributes->set('peran', $peran);

        return $next($request);
    }
}
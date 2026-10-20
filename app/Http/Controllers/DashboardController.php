<?php

namespace App\Http\Controllers;

use App\Models\AkunSosmed;
use App\Models\Influencer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Mengarahkan pengguna ke dashboard sesuai perannya, dan menampilkan halaman dashboard.
// Isi dashboard Admin dan Owner Brand masih kerangka; dibuat bertahap di step berikutnya.
class DashboardController extends Controller
{
    // Teks banner di halaman Status Verifikasi (sesuai wireframe), per status di tabel Influencer
    private const STATUS = [
        'menunggu' => [
            'judul' => 'Akun Anda sedang menunggu verifikasi',
            'deskripsi' => 'Data registrasi Anda sedang diperiksa oleh Admin. Dashboard dan menu campaign dapat diakses setelah akun diverifikasi.',
            'label' => 'Menunggu Verifikasi',
        ],
        'ditolak' => [
            'judul' => 'Verifikasi akun Anda ditolak',
            'deskripsi' => 'Data registrasi Anda tidak memenuhi persyaratan Aura Community.',
            'label' => 'Ditolak',
        ],
        'diverifikasi' => [
            'judul' => 'Akun Anda telah diverifikasi',
            'deskripsi' => 'Anda dapat melihat dan mendaftar campaign yang tersedia.',
            'label' => 'Diverifikasi',
        ],
    ];

    // Titik masuk setelah login (/dashboard): meneruskan pengguna sesuai perannya
    public function arahkan(Request $request)
    {
        $pengguna = Auth::user();

        switch ($pengguna->peran()) {
            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'owner_brand':
                return redirect()->route('owner.dashboard');

            case 'influencer':
                // Influencer yang belum diverifikasi hanya boleh melihat halaman Status Verifikasi
                $influencer = Influencer::findOrFail($pengguna->idPengguna);
                return $influencer->statusVerifikasi === 'diverifikasi'
                    ? redirect()->route('influencer.dashboard')
                    : redirect()->route('influencer.status');

            default:
                // Akun belum terdaftar sebagai Admin, Owner Brand, maupun Influencer
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->withErrors([
                    'email' => 'Akun Anda belum memiliki peran. Silakan hubungi Admin.',
                ]);
        }
    }

    // Dashboard Admin (kerangka)
    public function admin()
    {
        return view('dashboard.admin', ['pengguna' => Auth::user()]);
    }

    // Dashboard Owner Brand (kerangka)
    public function ownerBrand()
    {
        return view('dashboard.owner-brand', ['pengguna' => Auth::user()]);
    }

    // Dashboard Influencer (kerangka). Hanya untuk influencer yang sudah diverifikasi.
    public function influencer()
    {
        $pengguna = Auth::user();
        $influencer = Influencer::findOrFail($pengguna->idPengguna);

        if ($influencer->statusVerifikasi !== 'diverifikasi') {
            return redirect()->route('influencer.status');
        }

        return view('dashboard.influencer', ['pengguna' => $pengguna]);
    }

    // Halaman Status Verifikasi: data registrasi influencer dari tabel Pengguna, Influencer, AkunSosmed
    public function statusVerifikasi()
    {
        $pengguna = Auth::user();
        $influencer = Influencer::findOrFail($pengguna->idPengguna);

        // Akun media sosial milik influencer ini, dikelompokkan per nama platform
        $akun = AkunSosmed::where('idPengguna', $pengguna->idPengguna)->get()->keyBy('platform');

        return view('dashboard.influencer-status', [
            'pengguna' => $pengguna,
            'influencer' => $influencer,
            'akun' => $akun,
            'status' => self::STATUS[$influencer->statusVerifikasi],
        ]);
    }
}
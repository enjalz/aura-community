{{-- Halaman Status Verifikasi milik Influencer: status akun dan data registrasi.
     Datanya dari tabel Pengguna, Influencer, dan AkunSosmed (dikirim oleh DashboardController). --}}
@extends('layouts.dashboard')

@section('title', 'Status Verifikasi - Aura Community')
@section('judul', 'Status Verifikasi')
@section('menu_aktif', 'status')

{{-- Selama belum diverifikasi, menu lain dikunci (kecuali Status Verifikasi) --}}
@section('menu_terkunci', $influencer->statusVerifikasi !== 'diverifikasi' ? '1' : '0')

@section('isi')

    {{-- Banner status: ikon, judul, deskripsi, dan label --}}
    <div class="status-banner">
        <div class="status-banner__icon" aria-hidden="true">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                @if ($influencer->statusVerifikasi === 'diverifikasi')
                    {{-- Ikon centang --}}
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/>
                @elseif ($influencer->statusVerifikasi === 'ditolak')
                    {{-- Ikon silang --}}
                    <circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/>
                @else
                    {{-- Ikon jam --}}
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                @endif
            </svg>
        </div>
        <div class="status-banner__text">
            <h2 class="status-banner__title">{{ $status['judul'] }}</h2>
            <p class="status-banner__desc">{{ $status['deskripsi'] }}</p>
        </div>
        <span class="status-badge status-badge--{{ $influencer->statusVerifikasi }}">{{ $status['label'] }}</span>
    </div>

    {{-- Data registrasi --}}
    <h2 class="panel-title mt-4">Data Registrasi</h2>
    <dl class="data-list">
        <div class="data-list__row"><dt>Nama</dt><dd>{{ $pengguna->nama }}</dd></div>
        <div class="data-list__row"><dt>Email</dt><dd>{{ $pengguna->email }}</dd></div>
        <div class="data-list__row"><dt>No. Telepon</dt><dd>{{ $pengguna->noTelepon }}</dd></div>
        <div class="data-list__row"><dt>Alamat</dt><dd>{{ $pengguna->alamat }}</dd></div>
        <div class="data-list__row"><dt>Kategori</dt><dd>{{ $influencer->kategori }}</dd></div>

        {{-- Satu baris per platform. $akun berisi akun yang didaftarkan, dikelompokkan per platform. --}}
        @foreach (['Instagram', 'TikTok'] as $namaPlatform)
            <div class="data-list__row">
                <dt>Akun {{ $namaPlatform }}</dt>
                <dd>
                    @if ($akun->has($namaPlatform))
                        &#64;{{ $akun[$namaPlatform]->username }}
                        ({{ number_format($akun[$namaPlatform]->jumlahPengikut, 0, ',', '.') }} pengikut)
                    @else
                        -
                    @endif
                </dd>
            </div>
        @endforeach
    </dl>

    {{-- Catatan hanya muncul selama menunggu verifikasi --}}
    @if ($influencer->statusVerifikasi === 'menunggu')
        <p class="note-box mt-4 mb-0">
            Menu lain dinonaktifkan sampai akun diverifikasi oleh Admin. Data registrasi tidak dapat
            diubah selama menunggu verifikasi.
        </p>
    @endif

@endsection
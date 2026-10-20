{{-- Kerangka semua halaman dashboard (Admin, Owner Brand, Influencer): sidebar, topbar, dan isi.
     Halaman yang memakainya mengisi:
       @section('judul')        = judul di topbar
       @section('menu_aktif')   = kunci menu yang sedang dibuka (lihat config/menu.php)
       @section('menu_terkunci') = '1' kalau menu selain "selalu" harus dikunci
       @section('isi')          = isi halaman --}}
@extends('layouts.app')

{{-- CSS dashboard. Ditaruh di luar @section supaya ikut dimuat di <head>. --}}
@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endpush

@section('content')
    @php
        // Data pengguna yang sedang login dan perannya (diisi oleh PastikanPeran)
        $pengguna = auth()->user();
        $peran = request()->attributes->get('peran');

        // Menu sidebar sesuai peran, dari config/menu.php
        $menu = config('menu.' . $peran, []);
        $menuAktif = trim($__env->yieldContent('menu_aktif'));
        $menuTerkunci = trim($__env->yieldContent('menu_terkunci')) === '1';

        $labelPeran = ['admin' => 'Admin', 'owner_brand' => 'Owner Brand', 'influencer' => 'Influencer'][$peran] ?? '';
    @endphp

    <div class="dash">

        {{-- SIDEBAR. offcanvas-lg: di layar besar tampil tetap, di layar kecil menjadi panel geser. --}}
        <div class="dash-sidebar-wrap">
            <aside class="offcanvas-lg offcanvas-start dash-sidebar" tabindex="-1" id="sidebarMenu" aria-label="Menu samping">
                <div class="dash-sidebar__inner">

                    {{-- Tombol tutup panel (hanya di layar kecil) --}}
                    <div class="d-flex justify-content-end d-lg-none mb-2">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Tutup menu"></button>
                    </div>

                    {{-- Logo (sementara tulisan) --}}
                    <a class="dash-brand" href="{{ route('dashboard') }}">Aura Community</a>

                    {{-- Daftar menu. Menu aktif ditandai pink; menu yang halamannya belum dibuat
                         atau sedang dikunci tampil redup dan tidak bisa diklik. --}}
                    <nav aria-label="Menu utama">
                        @foreach ($menu as $item)
                            @if (isset($item['grup']))
                                <p class="dash-menu__group">{{ $item['grup'] }}</p>
                            @else
                                @php
                                    $halamanAda = Route::has($item['route']);
                                    $bisaDiklik = $halamanAda && (! $menuTerkunci || ($item['selalu'] ?? false));
                                    $aktif = $menuAktif === $item['kunci'];
                                @endphp

                                @if ($bisaDiklik)
                                    <a class="dash-menu__item {{ $aktif ? 'is-active' : '' }}"
                                       href="{{ route($item['route']) }}"
                                       @if ($aktif) aria-current="page" @endif>
                                        @include('partials.ikon', ['nama' => $item['ikon'] ?? ''])
                                        <span>{{ $item['label'] }}</span>
                                    </a>
                                @else
                                    <span class="dash-menu__item is-disabled" aria-disabled="true">
                                        @include('partials.ikon', ['nama' => $item['ikon'] ?? ''])
                                        <span>{{ $item['label'] }}</span>
                                    </span>
                                @endif
                            @endif
                        @endforeach
                    </nav>

                    {{-- Logout dikirim lewat POST + @csrf supaya tidak bisa dipicu dari link biasa --}}
                    <form method="POST" action="{{ route('logout') }}" class="dash-logout">
                        @csrf
                        <button type="submit" class="btn-aura btn-aura--outline w-100">
                            @include('partials.ikon', ['nama' => 'logout'])
                            Logout
                        </button>
                    </form>
                </div>
            </aside>
        </div>

        {{-- KOLOM KANAN: topbar dan isi halaman --}}
        <div class="dash-main">
            <header class="dash-topbar">
                <div class="dash-topbar__left">
                    {{-- Tombol pembuka sidebar (hanya di layar kecil) --}}
                    <button type="button" class="dash-toggle d-lg-none"
                            data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
                            aria-controls="sidebarMenu">Menu</button>
                    <h1 class="dash-title">@yield('judul')</h1>
                </div>

                {{-- Nama dan peran pengguna. Avatar berisi huruf pertama nama. --}}
                <div class="dash-user">
                    <div class="dash-user__text">
                        <div class="dash-user__name">{{ $pengguna->nama }}</div>
                        <div class="dash-user__role">{{ $labelPeran }}</div>
                    </div>
                    <div class="dash-avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr($pengguna->nama, 0, 1)) }}</div>
                </div>
            </header>

            <main class="dash-content">
                @yield('isi')
            </main>
        </div>

    </div>
@endsection
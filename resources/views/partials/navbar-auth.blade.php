{{-- Navbar sederhana untuk halaman Registrasi dan Login: logo di kiri, satu tombol di kanan.
     Tombolnya diatur dari halaman yang memanggil: $tombolLabel, $tombolUrl, $tombolClass. --}}
<header>
    <nav class="navbar navbar-aura" aria-label="Navigasi utama">
        <div class="container-aura">
            <a class="navbar-brand" href="{{ url('/') }}">Aura Community</a>
            <a class="btn-aura {{ $tombolClass }} btn-aura--sm" href="{{ $tombolUrl }}">{{ $tombolLabel }}</a>
        </div>
    </nav>
</header>

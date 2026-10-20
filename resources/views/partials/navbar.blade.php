{{-- Navbar halaman depan (landing page).
     Dipisah dari landing.blade.php supaya file utamanya tidak panjang. --}}
<header>
    <nav class="navbar navbar-expand-xl navbar-aura" aria-label="Navigasi utama">
        <div class="container-aura">

            {{-- Logo (sementara berupa tulisan, nanti diganti gambar logo) --}}
            <a class="navbar-brand" href="{{ url('/') }}">Aura Community</a>

            {{-- Tombol hamburger untuk membuka menu di layar kecil --}}
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#menuUtama"
                    aria-controls="menuUtama" aria-expanded="false"
                    aria-label="Buka atau tutup menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuUtama">

                {{-- Menu ke tiap section di halaman ini.
                     Section-nya baru dibuat di step berikutnya. --}}
                <ul class="navbar-nav mx-xl-auto">
                    <li class="nav-item"><a class="nav-link active" href="#beranda" aria-current="page">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portofolio">Portofolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimoni">Testimoni</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galeri Konten</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>

                {{-- Tombol ke halaman Login dan Registrasi Influencer (halamannya belum dibuat) --}}
                <div class="d-grid d-xl-flex gap-2 mt-3 mt-xl-0">
                    <a class="btn-aura btn-aura--outline btn-aura--sm" href="{{ url('/login') }}">Masuk</a>
                    <a class="btn-aura btn-aura--primary btn-aura--sm" href="{{ url('/register') }}">Daftar Influencer</a>
                </div>
            </div>
        </div>
    </nav>
</header>

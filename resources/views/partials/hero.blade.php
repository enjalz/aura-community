{{-- Hero: bagian pertama yang dilihat pengunjung (id="beranda" = tujuan menu Beranda).
     Teks di kiri, gambar di kanan; di HP gambar pindah ke bawah teks. --}}
<section id="beranda" class="section-aura">
    <div class="container-aura">
        <div class="row align-items-center g-5">

            <div class="col-lg-6">
                <h1 class="text-display">
                    Hubungkan Brand Anda dengan <span class="hl">Influencer</span> yang Tepat
                </h1>
                <p class="text-lead hero__text">
                    Aura Community membantu brand dan agency dalam menjalankan kebutuhan
                    influencer marketing melalui pengelolaan dan kolaborasi dengan Influencer.
                </p>

                {{-- Tombol menuju section Kontak dan section Layanan --}}
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a class="btn-aura btn-aura--primary" href="#kontak">Hubungi Aura Community</a>
                    <a class="btn-aura btn-aura--outline" href="#layanan">Lihat Layanan</a>
                </div>
            </div>

            <div class="col-lg-6">
                {{-- Gambar sementara. Nanti ganti dengan:
                     <img class="img-cover" src="{{ asset('img/hero.jpg') }}" alt="..."> --}}
                <div class="img-placeholder">Gambar Hero</div>
            </div>

        </div>
    </div>
</section>

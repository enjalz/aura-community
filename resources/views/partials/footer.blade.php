{{-- Footer: logo, daftar link, kontak, dan hak cipta. Kontak dibaca dari config/aura.php --}}
<footer class="footer-aura">
    <div class="container-aura">
        <div class="row g-5">

            {{-- Logo (sementara tulisan) dan deskripsi singkat --}}
            <div class="col-lg-4">
                <a class="footer-aura__brand" href="{{ url('/') }}">Aura Community</a>
                <p class="footer-aura__about">
                    Wadah eksplorasi struktural, kolaborasi gagasan, dan ekosistem kreatif publik terpadu.
                </p>
            </div>

            {{-- Kolom link ke section di halaman ini --}}
            <div class="col-6 col-lg-2">
                <h2 class="footer-aura__heading">Navigasi</h2>
                <ul class="footer-aura__list">
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="#tentang">Tentang Kami</a></li>
                    <li><a href="#layanan">Layanan</a></li>
                    <li><a href="#portofolio">Portofolio</a></li>
                </ul>
            </div>

            <div class="col-6 col-lg-2">
                <h2 class="footer-aura__heading">Eksplorasi</h2>
                <ul class="footer-aura__list">
                    <li><a href="#testimoni">Testimoni</a></li>
                    <li><a href="#galeri">Galeri Konten</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </div>

            {{-- Kolom kontak dan media sosial --}}
            <div class="col-lg-4">
                <h2 class="footer-aura__heading">Kontak &amp; Media Sosial</h2>
                <ul class="footer-aura__list">
                    <li>
                        <strong>WhatsApp:</strong>
                        <a href="https://wa.me/{{ config('aura.whatsapp_number') }}" target="_blank" rel="noopener noreferrer">{{ config('aura.whatsapp_display') }}</a>
                    </li>
                    <li>
                        <strong>Instagram:</strong>
                        <a href="https://instagram.com/{{ config('aura.instagram') }}" target="_blank" rel="noopener noreferrer">&#64;{{ config('aura.instagram') }}</a>
                    </li>
                    <li>
                        <strong>Email:</strong>
                        <a href="mailto:{{ config('aura.email') }}">{{ config('aura.email') }}</a>
                    </li>
                </ul>
            </div>

        </div>

        {{-- date('Y') mengambil tahun sekarang, jadi tidak perlu diubah tiap tahun --}}
        <div class="footer-aura__bottom">
            &copy; {{ date('Y') }} Aura Community. All rights reserved.
        </div>
    </div>
</footer>

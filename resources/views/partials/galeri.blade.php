{{-- Galeri Konten (id="galeri"): enam kotak foto atau video dokumentasi campaign. --}}
<section id="galeri" class="section-aura band-beige">
    <div class="container-aura">

        <div class="section-header">
            <h2 class="text-heading-lg">Galeri Konten</h2>
            <p class="text-lead">Dokumentasi konten dan kegiatan campaign yang dilakukan bersama Influencer.</p>
        </div>

        {{-- 6 kotak: 1 kolom di HP, 2 di tablet, 3 di desktop --}}
        <div class="row g-4">
            @for ($i = 0; $i < 6; $i++)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="img-placeholder gallery-item">Foto / Video</div>
                </div>
            @endfor
        </div>

    </div>
</section>

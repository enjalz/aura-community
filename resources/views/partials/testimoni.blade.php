{{-- Testimoni (id="testimoni"): tiga kartu ulasan client.
     Isinya masih contoh. Ganti dengan testimoni asli kalau sudah ada. --}}
<section id="testimoni" class="section-aura">
    <div class="container-aura">

        <div class="section-header">
            <h2 class="text-heading-lg">Testimoni</h2>
            <p class="text-lead">Tata letak feedback dan ulasan kerja sama dari mitra dan client.</p>
        </div>

        {{-- @for mengulang kartu sebanyak 3 kali --}}
        <div class="row g-4">
            @for ($i = 0; $i < 3; $i++)
                <div class="col-md-6 col-lg-4">
                    <div class="card-aura card-aura--stack h-100">

                        <div class="testimonial__head">
                            <div class="testimonial__avatar"></div>
                            <div>
                                <div class="testimonial__name">Nama Client</div>
                                <div class="testimonial__role">Perusahaan / Brand</div>
                            </div>
                        </div>

                        {{-- Bintang. aria-label membacakan nilainya untuk pembaca layar --}}
                        <div class="testimonial__stars" role="img" aria-label="Rating 5 dari 5">★★★★★</div>

                        <p class="testimonial__quote">“Testimoni client akan ditampilkan di sini.”</p>

                        <div class="card-foot testimonial__note">[Placeholder Testimoni]</div>
                    </div>
                </div>
            @endfor
        </div>

    </div>
</section>

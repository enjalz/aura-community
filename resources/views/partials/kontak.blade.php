{{-- Kontak (id="kontak"): dua kartu pilihan.
     Kiri untuk brand yang ingin bekerja sama (lewat WhatsApp),
     kanan untuk calon influencer (ke halaman registrasi). --}}
<section id="kontak" class="section-aura">
    <div class="container-aura">

        <div class="section-header">
            <h2 class="text-heading-lg">Hubungi &amp; Bergabung Bersama Kami</h2>
            <p class="text-lead">
                Pilih jalur kolaborasi yang sesuai dengan kebutuhan Brand Anda atau daftarkan diri
                Anda sebagai bagian dari komunitas Influencer kami.
            </p>
        </div>

        <div class="row g-4">

            {{-- Kartu untuk Brand dan Mitra. Nomor WhatsApp dibaca dari config/aura.php --}}
            <div class="col-md-6">
                <div class="card-aura card-aura--stack h-100">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/>
                        </svg>
                    </div>
                    <h3 class="text-heading-sm mb-2">Untuk Brand &amp; Mitra</h3>
                    <p class="text-muted-aura mb-4">
                        Tertarik bekerja sama untuk campaign brand Anda? Konsultasikan strategi
                        influencer marketing Anda langsung bersama tim Aura Community.
                    </p>
                    <div class="card-foot">
                        {{-- target="_blank" membuka WhatsApp di tab baru --}}
                        <a class="btn-aura btn-aura--primary w-100 mt-3"
                           href="https://wa.me/{{ config('aura.whatsapp_number') }}"
                           target="_blank" rel="noopener noreferrer">Hubungi via WhatsApp</a>
                    </div>
                </div>
            </div>

            {{-- Kartu untuk calon Influencer --}}
            <div class="col-md-6">
                <div class="card-aura card-aura--stack h-100">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <line x1="19" x2="19" y1="8" y2="14"/>
                            <line x1="22" x2="16" y1="11" y2="11"/>
                        </svg>
                    </div>
                    <h3 class="text-heading-sm mb-2">Ingin Bergabung Menjadi Influencer?</h3>
                    <p class="text-muted-aura mb-4">
                        Kembangkan potensi dan dapatkan kesempatan kolaborasi campaign bersama
                        berbagai brand ternama dalam jaringan Aura Community.
                    </p>
                    <div class="card-foot">
                        <a class="btn-aura btn-aura--outline w-100 mt-3" href="{{ url('/register') }}">Registrasi sebagai Influencer</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

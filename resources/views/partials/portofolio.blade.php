{{-- Portofolio (id="portofolio"): tiga contoh campaign yang pernah dijalankan.
     Datanya teks tetap dari wireframe, bukan dari tabel Campaign. --}}
@php
    // Daftar kartu. Untuk menambah kartu, cukup tambah satu baris di sini.
    $portofolio = [
        ['judul' => 'Franchise Kopi',     'deskripsi' => 'Dokumentasi campaign promosi untuk franchise kopi.',          'jenis' => 'Visit Campaign',        'jumlah' => 12],
        ['judul' => 'Produk Kecantikan',  'deskripsi' => 'Dokumentasi campaign promosi produk kecantikan.',             'jenis' => 'Review & Endorsement',  'jumlah' => 25],
        ['judul' => 'Promosi Digital',    'deskripsi' => 'Dokumentasi kegiatan promosi digital melalui media sosial.',  'jenis' => 'Aktivasi Konten',       'jumlah' => 18],
    ];
@endphp

<section id="portofolio" class="section-aura band-beige">
    <div class="container-aura">

        <div class="section-header">
            <h2 class="text-heading-lg">Portofolio</h2>
            <p class="text-lead">Dokumentasi kegiatan dan campaign yang telah dijalankan bersama Influencer.</p>
        </div>

        {{-- @foreach mengulang satu kartu untuk setiap item di daftar $portofolio --}}
        <div class="row g-4">
            @foreach ($portofolio as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card-aura card-aura--stack portfolio-card h-100">
                        <div class="img-placeholder portfolio-card__image">Gambar Campaign</div>
                        <div class="portfolio-card__body">
                            <h3 class="text-heading-sm mb-2">{{ $item['judul'] }}</h3>
                            <p class="text-muted-aura mb-4">{{ $item['deskripsi'] }}</p>
                            <div class="card-foot portfolio-card__meta">
                                <span class="portfolio-card__type">{{ $item['jenis'] }}</span>
                                <span class="text-muted-aura">{{ $item['jumlah'] }} Influencer</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

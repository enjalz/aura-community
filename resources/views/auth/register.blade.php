{{-- Halaman Registrasi Influencer. Formulirnya dikirim ke RegistrasiInfluencerController@simpan --}}
@extends('layouts.app')

@section('title', 'Registrasi Influencer - Aura Community')

{{-- CSS dan JavaScript khusus halaman ini --}}
@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('js/auth.js') }}" defer></script>
@endpush

@section('content')

    {{-- Navbar sederhana dengan tombol ke halaman Login --}}
    @include('partials.navbar-auth', [
        'tombolLabel' => 'Login',
        'tombolUrl'   => url('/login'),
        'tombolClass' => 'btn-aura--outline',
    ])

    <main class="auth-page">
        <div class="container-aura">
            <div class="auth-card auth-card--lebar">

                <h1 class="text-heading">Registrasi Influencer</h1>
                <p class="text-muted-aura mt-2 mb-4">
                    Isi data berikut untuk bergabung dengan Aura Community. Data akan diperiksa dan
                    diverifikasi oleh Admin sebelum akun dapat digunakan.
                </p>

                {{-- Pesan sukses setelah registrasi berhasil --}}
                @if (session('sukses'))
                    <div class="alert-aura" role="status">{{ session('sukses') }}</div>
                @endif

                {{-- Ringkasan kalau ada kolom yang salah diisi --}}
                @if ($errors->any())
                    <div class="alert-aura alert-aura--error" role="alert">
                        Data belum dapat disimpan. Periksa kolom yang ditandai merah di bawah.
                    </div>
                @endif

                {{-- novalidate = pemeriksaan dilakukan oleh server, supaya pesannya berbahasa Indonesia.
                     @csrf = token pengaman wajib di setiap formulir POST Laravel. --}}
                <form method="POST" action="{{ route('register.simpan') }}" novalidate data-cegah-ganda>
                    @csrf

                    <hr class="form-divider mt-0">
                    <p class="form-section-label">Data Diri</p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-aura" for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                   class="form-control @error('nama') is-error @enderror" placeholder="Nama lengkap">
                            @error('nama') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-aura" for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   class="form-control @error('email') is-error @enderror" placeholder="email@contoh.com">
                            @error('email') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-aura" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password"
                                       class="form-control @error('password') is-error @enderror" placeholder="Minimal 8 karakter">
                                <button type="button" class="input-toggle" data-toggle-password="#password" aria-pressed="false">Lihat</button>
                            </div>
                            @error('password') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-aura" for="password_confirmation">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="form-control" placeholder="Ulangi password">
                                <button type="button" class="input-toggle" data-toggle-password="#password_confirmation" aria-pressed="false">Lihat</button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-aura" for="noTelepon">No. Telepon</label>
                            <input type="tel" id="noTelepon" name="noTelepon" value="{{ old('noTelepon') }}"
                                   class="form-control @error('noTelepon') is-error @enderror" placeholder="Nomor WhatsApp aktif">
                            @error('noTelepon') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-aura" for="kategori">Kategori</label>
                            <select id="kategori" name="kategori" class="form-select @error('kategori') is-error @enderror">
                                <option value="">Pilih kategori</option>
                                {{-- Daftar kategori dikirim dari controller --}}
                                @foreach ($kategori as $pilihan)
                                    <option value="{{ $pilihan }}" @selected(old('kategori') === $pilihan)>{{ $pilihan }}</option>
                                @endforeach
                            </select>
                            @error('kategori') <p class="field-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label-aura" for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" rows="3"
                                      class="form-control @error('alamat') is-error @enderror" placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
                            @error('alamat') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <hr class="form-divider">
                    <p class="form-section-label">Akun Media Sosial</p>
                    <p class="form-hint">Isi minimal satu akun.</p>
                    @error('sosmed') <p class="field-error">{{ $message }}</p> @enderror

                    {{-- Satu blok isian untuk tiap platform (Instagram dan TikTok), dari daftar $platform --}}
                    @foreach ($platform as $kunci => $namaPlatform)
                        <h2 class="form-platform-title">{{ $namaPlatform }}</h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label-aura" for="{{ $kunci }}_username">Username</label>
                                <input type="text" id="{{ $kunci }}_username" name="{{ $kunci }}_username"
                                       value="{{ old($kunci . '_username') }}"
                                       class="form-control @error($kunci . '_username') is-error @enderror" placeholder="@username">
                                @error($kunci . '_username') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-aura" for="{{ $kunci }}_pengikut">Jumlah Pengikut</label>
                                <input type="number" min="0" id="{{ $kunci }}_pengikut" name="{{ $kunci }}_pengikut"
                                       value="{{ old($kunci . '_pengikut') }}"
                                       class="form-control @error($kunci . '_pengikut') is-error @enderror" placeholder="0">
                                @error($kunci . '_pengikut') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label-aura" for="{{ $kunci }}_link">Link Profil</label>
                                <input type="url" id="{{ $kunci }}_link" name="{{ $kunci }}_link"
                                       value="{{ old($kunci . '_link') }}"
                                       class="form-control @error($kunci . '_link') is-error @enderror"
                                       placeholder="Tautan profil {{ $namaPlatform }}">
                                @error($kunci . '_link') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    @endforeach

                    <hr class="form-divider">

                    <button type="submit" class="btn-aura btn-aura--primary w-100">Daftar</button>
                    <p class="auth-note">Sudah punya akun? <a href="{{ url('/login') }}">Login</a></p>
                </form>

            </div>
        </div>
    </main>

@endsection

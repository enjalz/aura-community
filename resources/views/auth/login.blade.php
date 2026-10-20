{{-- Halaman Login untuk semua peran. Formulirnya dikirim ke LoginController@masuk --}}
@extends('layouts.app')

@section('title', 'Login - Aura Community')

{{-- CSS dan JavaScript khusus halaman ini (sama dengan halaman registrasi) --}}
@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('js/auth.js') }}" defer></script>
@endpush

@section('content')

    {{-- Navbar sederhana dengan tombol ke halaman Registrasi --}}
    @include('partials.navbar-auth', [
        'tombolLabel' => 'Daftar Influencer',
        'tombolUrl'   => url('/register'),
        'tombolClass' => 'btn-aura--primary',
    ])

    <main class="auth-page">
        <div class="container-aura">
            <div class="auth-card auth-card--sempit">

                <h1 class="text-heading">Login</h1>
                <p class="text-muted-aura mt-2 mb-4">Masuk dengan email dan password akun Anda.</p>

                {{-- Pesan sukses (contoh: setelah registrasi berhasil) --}}
                @if (session('sukses'))
                    <div class="alert-aura" role="status">{{ session('sukses') }}</div>
                @endif

                {{-- Pesan error umum (email/password salah, akun tidak aktif, terlalu banyak percobaan) --}}
                @if ($errors->has('email') && ! $errors->has('password'))
                    <div class="alert-aura alert-aura--error" role="alert">{{ $errors->first('email') }}</div>
                @endif

                {{-- novalidate = pemeriksaan dilakukan oleh server. @csrf = token pengaman formulir. --}}
                <form method="POST" action="{{ route('login.proses') }}" novalidate data-cegah-ganda>
                    @csrf

                    <div class="mb-3">
                        <label class="form-label-aura" for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-error @enderror"
                               placeholder="email@contoh.com" autocomplete="username" autofocus>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-aura" for="password">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password"
                                   class="form-control @error('password') is-error @enderror"
                                   placeholder="Password" autocomplete="current-password">
                            <button type="button" class="input-toggle" data-toggle-password="#password" aria-pressed="false">Lihat</button>
                        </div>
                        @error('password') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="btn-aura btn-aura--primary w-100">Login</button>
                </form>

            </div>
        </div>
    </main>

@endsection
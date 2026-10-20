{{-- Dashboard Admin (kerangka). Ringkasan, tabel campaign, dan lainnya dibuat di step berikutnya. --}}
@extends('layouts.dashboard')

@section('title', 'Dashboard Admin - Aura Community')
@section('judul', 'Dashboard')
@section('menu_aktif', 'dashboard')

@section('isi')
    <div class="panel-aura">
        <h2 class="panel-title">Selamat datang, {{ $pengguna->nama }}</h2>
        <p class="text-muted-aura mb-0">
            Anda masuk sebagai Admin. Isi dashboard (ringkasan pengguna, ringkasan campaign, dan
            daftar yang perlu ditindak) akan dibuat di langkah berikutnya.
        </p>
    </div>
@endsection
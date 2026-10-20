{{-- Dashboard Owner Brand (kerangka). Ringkasan dan daftar campaign dibuat di step berikutnya. --}}
@extends('layouts.dashboard')

@section('title', 'Dashboard Owner Brand - Aura Community')
@section('judul', 'Dashboard')
@section('menu_aktif', 'dashboard')

@section('isi')
    <div class="panel-aura">
        <h2 class="panel-title">Selamat datang, {{ $pengguna->nama }}</h2>
        <p class="text-muted-aura mb-0">
            Anda masuk sebagai Owner Brand. Isi dashboard (ringkasan campaign dan laporan hasil campaign)
            akan dibuat di langkah berikutnya.
        </p>
    </div>
@endsection
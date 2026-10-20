{{-- Dashboard Influencer (kerangka), hanya untuk influencer yang sudah diverifikasi. --}}
@extends('layouts.dashboard')

@section('title', 'Dashboard Influencer - Aura Community')
@section('judul', 'Dashboard')
@section('menu_aktif', 'dashboard')
@section('menu_terkunci', '0')

@section('isi')
    <div class="panel-aura">
        <h2 class="panel-title">Selamat datang, {{ $pengguna->nama }}</h2>
        <p class="text-muted-aura mb-0">
            Akun Anda sudah diverifikasi. Daftar campaign dan menu lainnya akan dibuat di langkah berikutnya.
        </p>
    </div>
@endsection
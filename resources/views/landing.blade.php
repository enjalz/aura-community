{{-- Halaman depan (landing page) Aura Community.
     Isinya disusun dari potongan-potongan di folder partials. --}}
@extends('layouts.app')

@section('title', 'Aura Community')

@section('content')

    @include('partials.navbar')
    @include('partials.hero')
    @include('partials.tentang')
    @include('partials.layanan')
    @include('partials.portofolio')
    @include('partials.testimoni')
    @include('partials.galeri')
    @include('partials.kontak')
    @include('partials.footer')

@endsection
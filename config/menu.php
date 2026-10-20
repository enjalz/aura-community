<?php

// Daftar menu sidebar untuk tiap peran (sesuai wireframe).
// 'route' adalah nama route halaman tujuannya. Selama route itu belum dibuat,
// menu tampil redup dan tidak bisa diklik. Begitu route-nya dibuat, menu otomatis aktif.
// 'ikon' adalah nama ikon di resources/views/partials/ikon.blade.php.
// 'selalu' => true artinya menu tetap bisa diklik walaupun menu lain dikunci
// (dipakai untuk Status Verifikasi milik influencer yang belum diverifikasi).
return [

    'admin' => [
        ['kunci' => 'dashboard', 'label' => 'Dashboard', 'route' => 'admin.dashboard', 'ikon' => 'dashboard'],
        ['grup' => 'Pengguna'],
        ['kunci' => 'verifikasi-akun', 'label' => 'Verifikasi Akun', 'route' => 'admin.verifikasi', 'ikon' => 'verifikasi'],
        ['kunci' => 'data-influencer', 'label' => 'Data Influencer', 'route' => 'admin.influencer', 'ikon' => 'pengguna'],
        ['kunci' => 'data-owner-brand', 'label' => 'Data Owner Brand', 'route' => 'admin.owner-brand', 'ikon' => 'brand'],
        ['grup' => 'Campaign'],
        ['kunci' => 'campaign', 'label' => 'Campaign', 'route' => 'admin.campaign', 'ikon' => 'campaign'],
        ['kunci' => 'hasil-campaign', 'label' => 'Hasil Campaign', 'route' => 'admin.hasil', 'ikon' => 'hasil'],
        ['kunci' => 'verifikasi-insight', 'label' => 'Verifikasi Insight', 'route' => 'admin.insight', 'ikon' => 'insight'],
        ['kunci' => 'pembayaran', 'label' => 'Pembayaran', 'route' => 'admin.pembayaran', 'ikon' => 'pembayaran'],
        ['kunci' => 'laporan', 'label' => 'Laporan Hasil Campaign', 'route' => 'admin.laporan', 'ikon' => 'laporan'],
        ['kunci' => 'riwayat', 'label' => 'Riwayat Campaign', 'route' => 'admin.riwayat', 'ikon' => 'riwayat'],
        ['grup' => 'Akun'],
        ['kunci' => 'profil', 'label' => 'Profil', 'route' => 'admin.profil', 'ikon' => 'profil'],
    ],

    'owner_brand' => [
        ['kunci' => 'dashboard', 'label' => 'Dashboard', 'route' => 'owner.dashboard', 'ikon' => 'dashboard'],
        ['grup' => 'Campaign'],
        ['kunci' => 'campaign', 'label' => 'Campaign', 'route' => 'owner.campaign', 'ikon' => 'campaign'],
        ['kunci' => 'laporan', 'label' => 'Laporan Hasil Campaign', 'route' => 'owner.laporan', 'ikon' => 'laporan'],
        ['kunci' => 'riwayat', 'label' => 'Riwayat Campaign', 'route' => 'owner.riwayat', 'ikon' => 'riwayat'],
        ['grup' => 'Akun'],
        ['kunci' => 'profil', 'label' => 'Profil', 'route' => 'owner.profil', 'ikon' => 'profil'],
    ],

    'influencer' => [
        ['kunci' => 'dashboard', 'label' => 'Dashboard', 'route' => 'influencer.dashboard', 'ikon' => 'dashboard'],
        ['grup' => 'Campaign'],
        ['kunci' => 'campaign', 'label' => 'Campaign', 'route' => 'influencer.campaign', 'ikon' => 'campaign'],
        ['kunci' => 'hasil', 'label' => 'Hasil Pengerjaan', 'route' => 'influencer.hasil', 'ikon' => 'hasil'],
        ['kunci' => 'riwayat', 'label' => 'Riwayat Campaign', 'route' => 'influencer.riwayat', 'ikon' => 'riwayat'],
        ['grup' => 'Akun'],
        ['kunci' => 'status', 'label' => 'Status Verifikasi', 'route' => 'influencer.status', 'ikon' => 'status', 'selalu' => true],
        ['kunci' => 'profil', 'label' => 'Profil', 'route' => 'influencer.profil', 'ikon' => 'profil'],
    ],

];
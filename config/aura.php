<?php

// Data kontak Aura Community yang dipakai di halaman web (tombol WhatsApp dan footer).
// Nilainya dibaca dari file .env; kalau belum diisi, dipakai nilai bawaan di sini.
return [

    // Nomor WhatsApp untuk link wa.me: angka saja, diawali 62, tanpa + atau spasi
    'whatsapp_number' => env('AURA_WHATSAPP_NUMBER', '628000000000'),

    // Tulisan nomor yang ditampilkan ke pengunjung
    'whatsapp_display' => env('AURA_WHATSAPP_DISPLAY', '+62 8xx-xxxx-xxxx'),

    // Username Instagram tanpa tanda @
    'instagram' => env('AURA_INSTAGRAM', 'auracommunity'),

    'email' => env('AURA_EMAIL', 'halo@auracommunity.id'),
];
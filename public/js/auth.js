// JavaScript untuk halaman Registrasi dan Login.

// Tombol "Lihat / Sembunyikan" di samping kolom password.
// Tombol memakai atribut data-toggle-password="#idKolomPassword" untuk menunjuk kolomnya.
document.querySelectorAll('[data-toggle-password]').forEach(function (tombol) {
  tombol.addEventListener('click', function () {
    var kolom = document.querySelector(tombol.dataset.togglePassword);
    var sedangTersembunyi = kolom.type === 'password';

    kolom.type = sedangTersembunyi ? 'text' : 'password';
    tombol.textContent = sedangTersembunyi ? 'Sembunyikan' : 'Lihat';
    tombol.setAttribute('aria-pressed', sedangTersembunyi ? 'true' : 'false');
  });
});

// Mencegah formulir terkirim dua kali kalau tombol Daftar/Login diklik berulang.
// Berlaku untuk formulir yang punya atribut data-cegah-ganda.
document.querySelectorAll('form[data-cegah-ganda]').forEach(function (formulir) {
  formulir.addEventListener('submit', function () {
    var tombolKirim = formulir.querySelector('button[type="submit"]');
    tombolKirim.disabled = true;
    tombolKirim.textContent = 'Memproses...';
  });
});

# Eco Clay Art

Website e-commerce untuk produk kerajinan tanah liat (clay art) ramah lingkungan, dibangun menggunakan framework **Laravel**.

## Tentang Project

Eco Clay Art adalah platform yang memungkinkan pelanggan untuk melihat, memesan, dan membeli produk kerajinan tanah liat. Project ini dilengkapi dengan panel admin untuk mengelola produk, pesanan, dan testimoni pelanggan.

## Fitur

- Halaman landing page untuk menampilkan produk
- Sistem pemesanan produk (order)
- Panel admin dengan autentikasi terpisah
- Manajemen produk
- Manajemen testimoni pelanggan
- Pengaturan (settings) website

## Teknologi yang Digunakan

- **Backend:** Laravel (PHP)
- **Database:** SQLite / MySQL
- **Frontend:** Blade Template, Vite

## Instalasi

1. Clone repository ini
   ```bash
   git clone https://github.com/RamadhanZaki/Eco.Clay.Art.git
   cd Eco.Clay.Art
   ```

2. Install dependency PHP
   ```bash
   composer install
   ```

3. Install dependency JavaScript
   ```bash
   npm install
   ```

4. Salin file environment
   ```bash
   cp .env.example .env
   ```

5. Generate application key
   ```bash
   php artisan key:generate
   ```

6. Jalankan migrasi database
   ```bash
   php artisan migrate
   ```

7. Jalankan server lokal
   ```bash
   php artisan serve
   ```

8. Jalankan Vite untuk asset frontend (di terminal terpisah)
   ```bash
   npm run dev
   ```

## Kontribusi

Kontribusi, saran, dan laporan bug sangat diterima. Silakan buat *issue* atau *pull request* jika ingin berkontribusi pada project ini.

## Lisensi

Project ini dibuat untuk keperluan pembelajaran (tugas kuliah Semester 6 - Jukii).
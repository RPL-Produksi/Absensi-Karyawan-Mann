# Absensi Karyawan Documentation

## Description

Absensi Karyawan adalah sebuah aplikasi berbasis web untuk pencatatan kehadiran karyawan secara online yang dikembangkan untuk lingkungan perusahaan atau institusi. Aplikasi ini bertujuan untuk memudahkan proses absensi dengan menyediakan antarmuka yang aman, mudah diakses, dan dapat diandalkan. Dengan Absensi Karyawan, karyawan dapat melakukan pencatatan kehadiran secara online, baik melalui perangkat desktop. Proyek ini dikembangkan menggunakan framework Laravel, yang menawarkan fitur MVC (Model-View-Controller) untuk pengembangan aplikasi berbasis web yang modular dan terstruktur.

## Architecture

Absensi Karyawan dibangun dengan pendekatan arsitektur MVC (Model-View-Controller) yang disediakan oleh Laravel. Struktur folder disusun untuk memisahkan logika aplikasi, antarmuka pengguna, dan data, dengan tujuan meningkatkan skalabilitas dan mempermudah pemeliharaan.

Berikut adalah struktur utama dari aplikasi:

- **app**: Menyimpan logika aplikasi seperti model dan controller.
- **routes**: Menyimpan file routing yang mendefinisikan endpoint aplikasi.
- **resources/views**: Berisi file blade template yang bertindak sebagai antarmuka pengguna.
- **public**: Direktori yang berisi file yang dapat diakses langsung, seperti gambar dan file JavaScript/CSS.

Flow dari aplikasi mengikuti diagram berikut, di mana setiap permintaan (Request) diproses melalui beberapa tahap sebelum data akhirnya dikembalikan kepada pengguna:

```mermaid
graph LR
Request-->r(Route)-->m(Middleware)-->c(Controllers)-->mm(Model)
c-->Request
```

### Configuration & Setup

Untuk menjalankan aplikasi Absensi Karyawan ini, beberapa konfigurasi dasar perlu disesuaikan pada file `.env`. Berikut adalah konfigurasi utama yang diperlukan:

- **Database**: Setelan untuk koneksi database, termasuk `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`.
- **Filesystem**: Konfigurasi untuk penyimpanan file yang mendukung berbagai disk penyimpanan, seperti `local`, `public`, atau `s3`. Pastikan untuk mengatur `FILESYSTEM_DISK` di `.env`, misalnya:
  ```dotenv
  FILESYSTEM_DISK=public
  ```
- **Credentials Admin**: Credentials admin, di simpan pada `.env` supaya lebih aman, dan berikut contohnya
  ```dotenv
  ADMIN_FULLNAME="Admin"
  ADMIN_USERNAME="admin"
  ADMIN_EMAIL="admin@example.com"
  ADMIN_PASSWORD="password"
  ADMIN_ADDRESS="Jl. Menuju Pintu Surga"
  ADMIN_PHONE="081234567890"
  ADMIN_POSITION="Administrator"
  ```

Aplikasi ini menggunakan beberapa library penting yang kompatibel dengan Laravel versi terbaru untuk mendukung fitur absensi karyawan.

## Installation

Untuk menginstal dan menjalankan aplikasi ini, ikuti langkah-langkah berikut:

```bash
git clone https://github.com/RPL-Produksi/Absensi-Karyawan-Mann.git
cd Absensi-Karyawan-Mann
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

## Maintenance & Troubleshooting

### Maintenance

Untuk menjaga aplikasi tetap berjalan dengan baik, berikut adalah beberapa tindakan pemeliharaan yang perlu dilakukan secara rutin:

- **Backup Database**: Buat backup database secara berkala untuk menghindari kehilangan data. Anda dapat menggunakan fitur backup otomatis atau membuat skrip backup yang dijalankan melalui cron job.
- **Log Monitoring**: Periksa file log aplikasi yang terletak di `storage/logs/laravel.log` secara berkala untuk mengidentifikasi error atau peringatan yang memerlukan tindakan.
- **Update Dependencies**: Pastikan untuk selalu menggunakan versi terbaru dari Laravel dan library lain yang digunakan, terutama ketika ada pembaruan keamanan.
- **Optimize Cache**: Jalankan `php artisan optimize` dan `php artisan config:cache` untuk mengoptimalkan kinerja cache dan konfigurasi aplikasi.

### Troubleshooting

Beberapa masalah umum dan solusi yang mungkin membantu:

1. **500 Internal Server Error**:

   - Periksa file `.env` untuk memastikan konfigurasi, terutama pada bagian `APP_KEY`, `DB_CONNECTION`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`, sudah benar.
   - Jalankan `php artisan config:cache` untuk memastikan cache konfigurasi diperbarui setelah melakukan perubahan di `.env`.

2. **Error saat Menjalankan Composer Install**:

   - Jika muncul pesan error terkait dependensi, coba jalankan `composer update` untuk memperbarui versi library yang kompatibel.
   - Pastikan versi PHP yang terpasang kompatibel dengan versi Laravel dan library yang digunakan.

3. **Cache Tidak Diperbarui**:

   - Untuk memastikan perubahan dalam aplikasi diterapkan, jalankan perintah berikut untuk membersihkan dan mengoptimalkan cache:
     ```bash
     php artisan cache:clear
     php artisan view:clear
     php artisan route:clear
     php artisan config:clear
     php artisan optimize
     ```

4. **Migrasi Database Gagal**:

   - Jika perintah `php artisan migrate` mengalami error, periksa apakah database telah diinisialisasi dan kredensial pada file `.env` sudah benar.
   - Jika tabel sudah ada dan Anda mencoba menambahkan kolom baru, gunakan `php artisan migrate:fresh` untuk memulai migrasi dari awal (peringatan: ini akan menghapus data lama).

5. **Error di Saat Menjalankan Storage atau Filesystem**:
   - Pastikan disk penyimpanan yang dikonfigurasi pada `FILESYSTEM_DISK` di `.env` sudah benar. Jika menggunakan `public`, jalankan `php artisan storage:link` untuk membuat symbolic link ke `public/storage`.
   - Periksa konfigurasi `FILESYSTEM_DISK` jika menggunakan layanan eksternal seperti S3.

Dengan panduan di atas, Anda diharapkan dapat menjaga aplikasi Absensi Karyawan tetap berjalan optimal dan mengatasi masalah umum yang mungkin muncul.

## References

Berikut adalah sumber-sumber referensi yang berguna untuk pengembangan dan pemeliharaan aplikasi Absensi Karyawan:

- [Laravel Documentation](https://laravel.com/docs): Dokumentasi resmi Laravel untuk referensi terkait berbagai fitur, konfigurasi, dan panduan penggunaan.
- [Mermaid Documentation](https://mermaid-js.github.io/mermaid): Dokumentasi untuk Mermaid, alat diagram yang digunakan untuk membuat diagram arsitektur.
- [PHP Documentation](https://www.php.net/docs.php): Dokumentasi resmi PHP untuk informasi lebih lanjut terkait penggunaan dan fungsi PHP.
- [Composer Documentation](https://getcomposer.org/doc/): Panduan penggunaan Composer, manajer dependensi PHP, yang digunakan untuk mengelola library di Laravel.
- [DigitalOcean: How to Deploy Laravel Applications](https://www.digitalocean.com/community/tutorials): Kumpulan tutorial untuk meng-host aplikasi Laravel dan panduan konfigurasi server.
- [GitHub Laravel Filesystem Documentation](https://github.com/laravel/docs/blob/10.x/filesystem.md): Dokumentasi terkait konfigurasi dan penggunaan Filesystem di Laravel, termasuk cara integrasi dengan layanan seperti S3.
- [Bootstrap Documentation](https://getbootstrap.com/docs/5.3/getting-started/introduction/): Dokumentasi resmi Bootstrap untuk desain responsif dan komponen UI yang digunakan dalam aplikasi.

Referensi-referensi ini dapat membantu dalam mengelola dan memperdalam pemahaman mengenai aplikasi Absensi Karyawan dan teknologi pendukungnya.

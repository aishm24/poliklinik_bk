# Proyek Laravel 10

Proyek ini adalah aplikasi berbasis Laravel 10. Dokumentasi ini mencakup langkah-langkah untuk menjalankan proyek.

## Prasyarat
Sebelum menjalankan proyek, pastikan perangkat Anda sudah memenuhi persyaratan berikut:
- PHP >= 8.1
- Composer
- MySQL (atau database lainnya yang didukung Laravel)

## Cara Menjalankan Proyek

1. Clone Repositori 
   Salin repositori ini ke perangkat Anda:
   ```bash
   git clone https://github.com/username/repository-name.git
   cd repository-name
   ```

2. Instalasi dan konfigurasi
    - a. Instal Dependensi: 
        Jalankan perintah berikut untuk menginstal semua dependensi:
        ```bash
        composer install
        ```
    - b. Salin File .env:
        Salin file `.env.example` menjadi `.env`:
        ```bash
        cp .env.example .env
        ```
    - c. Konfigurasi Database:
        Edit file `.env` dan sesuaikan pengaturan database:
        ```
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=nama_database
        DB_USERNAME=username_database
        DB_PASSWORD=password_database
        ```
    - d. Generate Application Key:
        Jalankan perintah berikut untuk menghasilkan kunci aplikasi:
        ```bash
        php artisan key:generate
        ```

3. Migrasi Database  
    - **a. Migrasi Tabel Polis:**  
        Jalankan perintah berikut untuk membuat tabel `polis`:
        ```bash
        php artisan migrate --path=database/migrations/2024_11_26_161055_create_polis_table.php
        ```
    - **b. Migrasi Tabel Dokters:**  
        Jalankan perintah berikut untuk membuat tabel `dokters`:
        ```bash
        php artisan migrate --path=database/migrations/2024_11_26_161045_create_dokters_table.php
        ```
    - **c. Migrasi Tabel Jadwal Periksas:**  
        Jalankan perintah berikut untuk membuat tabel `jadwal_periksas`:
        ```bash
        php artisan migrate --path=database/migrations/2024_11_26_160737_create_jadwal_periksas_table.php
        ```
    - **d. Migrasi Tabel Pasiens:**  
        Jalankan perintah berikut untuk membuat tabel `pasiens`:
        ```bash
        php artisan migrate --path=database/migrations/2024_11_26_160618_create_pasiens_table.php
        ```
    - **e. Migrasi Tabel Daftar Polis:**  
        Jalankan perintah berikut untuk membuat tabel `daftar_polis`:
        ```bash
        php artisan migrate --path=database/migrations/2024_11_26_160644_create_daftar_polis_table.php
        ```
    - **f. Migrasi Tabel Periksas:**  
        Jalankan perintah berikut untuk membuat tabel `periksas`:
        ```bash
        php artisan migrate --path=database/migrations/2024_11_26_160706_create_periksas_table.php
        ```
    - **g. Migrasi Tabel Obats:**  
        Jalankan perintah berikut untuk membuat tabel `obats`:
        ```bash
        php artisan migrate --path=database/migrations/2024_11_26_160721_create_obats_table.php
        ```
    - **h. Migrasi Tabel Detail Periksas:**  
        Jalankan perintah berikut untuk membuat tabel `detail_periksas`:
        ```bash
        php artisan migrate --path=database/migrations/2024_11_26_161007_create_detail_periksas_table.php
        ```
    - **i. Migrasi Tabel Users:**  
        Jalankan perintah berikut untuk membuat tabel `users`:
        ```bash
        php artisan migrate --path=database/migrations/2014_10_12_000000_create_users_table.php
        ```
    - **j. Migrasi Semua Tabel yang Tersisa:**  
        Jalankan perintah berikut untuk menyelesaikan semua migrasi:
        ```bash
        php artisan migrate
        ```

4. Jalankan Server Lokal: php artisan serve

5. Buka browser dan akses: http://localhost:8000
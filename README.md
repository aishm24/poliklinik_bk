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

2. Instalasi dan konfigurasi
    a. Instal Dependensi : composer install
    b. Salin File .env : cp .env.example .env
    c. Konfigurasi Database, Edit file .env dan sesuaikan pengaturan database:
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=nama_database
        DB_USERNAME=username_database
        DB_PASSWORD=password_database
    d. Generate Application Key: php artisan key:generate

3. Migrasi Database: php artisan migrate
    a. php artisan migrate --path=/database/migrations/2024_11_26_161055_create_polis_table.php
    b. php artisan migrate --path=/database/migrations/2024_11_26_161045_create_dokters_table.php
    c. php artisan migrate --path=/database/migrations/2024_11_26_160737_create_jadwal_periksas_table.php
    d. php artisan migrate --path=/database/migrations/2024_11_26_160618_create_pasiens_table.php
    e. php artisan migrate --path=/database/migrations/2024_11_26_160644_create_daftar_polis_table.php
    f. php artisan migrate --path=/database/migrations/2024_11_26_160706_create_periksas_table.php
    g. php artisan migrate --path=/database/migrations/2024_11_26_160721_create_obats_table.php
    h. php artisan migrate --path=/database/migrations/2024_11_26_161007_create_detail_periksas_table.php
    i. php artisan migrate --path=/database/migrations/2014_10_12_000000_create_users_table.php
    j. php artisan migrate

4. Jalankan Server Lokal: php artisan serve

5. Buka browser dan akses: http://localhost:8000
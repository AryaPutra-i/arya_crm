# CRM PT.SMART
Demo : https://aryacrm-production-f9ce.up.railway.app

Tect Stack
> Framework : Laravel 13
> Admin panel : Filament v5
> Styling tailwind CSS 4
> Database: MySQL

Fitur Utama
> Multi Role Dasboard: Tampilan dinamis sesuai dengan peran user
> Data isolation implementasi keamanan dimana sales hanya bisa melihat data miliknya sendiri, tetapi menager memiliki akses ke semua data
> Deal pipeline & approval : sistem konversi prospek menjadi klien dengan fitur negosisasi dab persetujuan
> Reporting : laporan penjualan yang dapat difilter berdasarkan periode

# Panduan instalasi lokal
1. Persyaratan sistem
   > PHP >= 8.5.5
   > Composer 2.x
   > Node.js & NPM
   > MySql atau MariaDb

2. instalasi
   ```bash
   1. clone repositori
   git clone https://github.com/AryaPutra-i/arya_crm.git
   cd arya_crm

   2. install composer
   composer install

   3. instal npm & run build
   npm install
   npm run build

   4. konfigurasi ENV
   cp .env.example .env
   php artisan key:generate

   5. konfigurasi database
   buka file .env dan sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD

3. Migrasi & seeding
   ```bash
   php artisan migrate --seed

4. jalankan aplikasi
   buka 2 terminal dalam code editor dan jalankan
   ```bash
   1. terminal 1
   npm run dev

   2. terminal 2
   php artisan serve

5. akun testing
   Manager : 
   > email : manager@gmail.com
   > password : manager123
   sales budi :
   > email : budi@gmail.com
   > password : budisales123
   sales angga :
   > email : angga@gmail.com
   > password : anggasales123

   

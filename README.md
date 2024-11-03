# 📊 Dompetku - Aplikasi Manajemen Keuangan Pribadi

[![Laravel](https://img.shields.io/badge/Laravel-11.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Filament](https://img.shields.io/badge/Filament-3.0-FB70A9?style=for-the-badge&logo=filament&logoColor=white)](https://filamentphp.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.0-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)

Dompetku adalah aplikasi manajemen keuangan pribadi yang membantu Anda melacak pemasukan dan pengeluaran dengan mudah. Dilengkapi dengan fitur kategorisasi, pengelolaan multiple bank account, dan sistem tag untuk organisasi yang lebih baik.

## ✨ Fitur Utama

-   💰 Pencatatan uang masuk dan keluar
-   📑 Manajemen kategori transaksi
-   🏦 Pengelolaan multiple bank account
-   🏷️ Sistem tag untuk tracking lebih detail
-   📱 Responsive design dengan Bootstrap 5
-   🎯 Dashboard admin yang powerful dengan Filament

## 🚀 Cara Instalasi

### Prasyarat

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL/MariaDB

### Langkah Instalasi

1. Clone repository ini

```bash
git clone https://github.com/ramaboy13/Dompetku-Filament.git
cd Dompetku-Filament
```

2. Install dependencies PHP

```bash
composer install
```

3. Install dependencies JavaScript

```bash
npm install
```

4. Salin file .env.example

```bash
cp .env.example .env
```

5. Generate application key

```bash
php artisan key:generate
```

6. Konfigurasi database di file .env

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
```

7. Jalankan migrasi dan seeder

```bash
php artisan migrate --seed
```

8. Build assets

```bash
npm run dev
```

9. Jalankan server

```bash
php artisan serve
```

## 📖 Penggunaan

1. Buka browser dan akses `http://localhost:8000`
2. Register dan Login dengan email dan password :
    - Email: admin@example.com
    - Password: password

## 🛠️ Teknologi yang Digunakan

-   [Laravel 11](https://laravel.com) - PHP Framework
-   [Laravel Filament](https://filamentphp.com) - Admin Panel Builder
-   [Bootstrap 5](https://getbootstrap.com) - Frontend Framework
-   MySQL - Database

## 📝 Lisensi

[MIT License](LICENSE.md)

## 👨‍💻 Kontribusi

Kontribusi selalu welcome! Silakan buat pull request atau buka issue untuk saran dan perbaikan.

## 📧 Kontak

Jika Anda memiliki pertanyaan atau saran, silakan hubungi:

-   Email: baritosurya13@gmail.com
-   GitHub: [@ramaboy_13](https://github.com/ramaboy13)

## ⭐ Dukung Project Ini

Jika Anda merasa terbantu dengan aplikasi ini, berikan bintang ⭐ pada repository ini!

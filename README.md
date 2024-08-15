<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

Project ini merupakan website sistem informasi management sekolah dan laporan penggunaan dana BOS pada SDN 3 Sungai Tiung. Website ini dibangun menggunakan framework Laravel serta Tailwind CSS dengan menggunakan server MySql sebagai database.

## Website Features

- [x] Laporan siswa
- [x] Laporan guru dan staff
- [x] Laporan keuangan
- [x] Laporan inventaris
- [x] Laporan rapot akademik
- [x] Laporan rapot p5 
- [x] Dashboard admin 
- [x] Dashboard guru 
- [x] Dashboard wali murid

## Whats You Need To Run This App
- Download and import database "db_sdn3sungaitiung". Download the database in source tab.
- Composer and PHP version 8.2 or above with Xampp,etc.
- make new file ".env" and copy from file ".env.example".
- make sure database connection on file ".env".
- run command "composer update" in your terminal.
- run command "php artisan key:generate --show" to generate general key for laravel
- also run command "php artisan cache:clear" and "php artisan config:clear".
- to run web-app via laravel, run command "php artisan serve"

## Documentation

Laravel => https://www.youtube.com/playlist?list=PLqDySLfPKRn5d7WbN9R0yJA9IRgx-XBlU
Tailwind component => https://www.hyperui.dev/ & https://flowbite.com/docs/getting-started/quickstart/

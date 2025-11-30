# Inventory Management System

Inventory Management System adalah aplikasi berbasis web yang dibangun menggunakan **PHP (Laravel + Blade)** untuk membantu mengelola stok barang, data inventaris, dan proses terkait lainnya.

## Daftar Isi

-   [Pendahuluan](#pendahuluan)
-   [Fitur](#fitur)
-   [Teknologi yang Digunakan](#teknologi-yang-digunakan)
-   [Instalasi](#instalasi)
-   [Konfigurasi](#konfigurasi)
-   [Penggunaan](#penggunaan)

## Pendahuluan

Inventory Management System ini menyediakan solusi berbasis web untuk mengelola barang inventaris, stok, dan data terkait lainnya. Proyek ini dibangun menggunakan kerangka kerja modern PHP yaitu Laravel, dengan struktur aplikasi yang jelas dan mudah dikembangkan.

## Fitur

-   CRUD lengkap untuk pengelolaan barang (create, read, update, delete)
-   Antarmuka web menggunakan Laravel & Blade Templates
-   Routing, database, dan konfigurasi standar Laravel
-   Struktur folder mengikuti standar Laravel (app, config, database, public, resources, routes, dll.)
-   Tersedia file contoh konfigurasi `.env.example`
-   Direktori `tests/` disediakan untuk pengujian (jika diperlukan)

## Teknologi yang Digunakan

-   **Backend:** PHP, Laravel Framework
-   **Frontend / Template:** Blade Template Engine
-   **Dependencies & Tooling:** Composer, NPM (jika frontend asset memerlukan)
-   **Database:** Dapat dikonfigurasi via Laravel (MySQL / PostgreSQL / SQLite)

## Instalasi

1. Clone repositori
    ```bash
    git clone https://github.com/HamdiHarahap/inventory-management-system.git
    cd inventory-management-system
    ```
2. Instal dependensi PHP
    ```bash
    composer install
    ```
3. Instal dependensi JavaScript
    ```bash
    npm install
    ```
4. Salin file environment
    ```bash
    cp .env.example .env
    ```
5. Sesuaikan file .env dengan konfigurasi database dan pengaturan lainnya.
6. Jalankan migrasi jika database diperlukan
    ```bash
    php artisan migrate
    ```
7. Jalankan Aplikasi
    ```bash
    composer run dev
    ```

## Penggunaan

Setelah aplikasi berjalan, buka browser dan akses:

```bash
http://127.0.0.1:8000
```

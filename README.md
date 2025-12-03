# Inventory Management System

Inventory Management System adalah aplikasi berbasis web yang dibangun menggunakan **PHP (Laravel + Blade)** untuk membantu mengelola stok barang, data inventaris, dan proses terkait lainnya.

## Daftar Isi

-   [Pendahuluan](#pendahuluan)
-   [Fitur](#fitur)
-   [Teknologi yang Digunakan](#teknologi-yang-digunakan)
-   [Alur Transaksi](#alur-transaksi)
-   [Instalasi](#instalasi)
-   [Konfigurasi](#konfigurasi)
-   [Penggunaan](#penggunaan)

## Pendahuluan

Inventory Management System ini menyediakan solusi berbasis web untuk mengelola barang inventaris, stok, dan data terkait lainnya. Proyek ini dibangun menggunakan kerangka kerja modern PHP yaitu Laravel, dengan struktur aplikasi yang jelas dan mudah dikembangkan.

Aplikasi ini cocok digunakan untuk:

-   Toko retail
-   Gudang
-   Distributor
-   UMKM

## Fitur

-   Manajemen Produk
    -   SKU otomatis (Format: PRD-000001)
    -   Barcode otomatis (13 digit)
    -   Harga beli & harga jual
    -   Update stok otomatis
-   Manajemen Kategori
    -   Kategori produk agar data lebih terorganisasi
-   Manajemen Supplier & Customer
-   Transaksi Masuk
    -   Pilih supplier
    -   Tambah item produk
    -   Stok bertambah otomatis
-   Transaksi Keluar
    -   Pilih customer
    -   Validasi stok tidak boleh minus
    -   Stok berkurang otomatis
-   Log Aktivitas
    -   Pencatatan semua aktivitas (tambah, ubah, hapus, transaksi)
-   Antarmuka Modern
    -   Menggunakan Blade + TailwindCSS

## Teknologi yang Digunakan

-   **Backend:** PHP, Laravel Framework
-   **Frontend / Template:** Blade Template Engine
-   **Dependencies & Tooling:** Composer, NPM (jika frontend asset memerlukan)
-   **Database:** MySQL

## Alur Transaksi

### Transaksi Masuk

-   Staff membuka halaman Transaksi Masuk
-   Pilih Supplier
-   Pilih Produk dan isi Qty
-   Harga otomatis menggunakan price_buy dari produk
-   Klik Simpan
-   Sistem akan:
    -   Menambah record transaksi masuk
    -   Menambah detail item di transaction_items
    -   Mengupdate stok bertambah
    -   Mencatat activity log

### Transaksi Keluar

-   Staff membuka halaman Transaksi Keluar
-   Pilih Customer
-   Pilih Produk dan Qty
-   Harga menggunakan price_sell
-   Simpan
-   Sistem akan:
    -   Memvalidasi stok cukup
    -   Menambah record outgoing transaction
    -   Menambah detail item
    -   Mengurangi stok
    -   Mencatat activity log

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
    php artisan migrate --seed
    ```
7. Jalankan Aplikasi
    ```bash
    composer run dev
    ```

## Akun Demo

### Manager

```bash
email: manager@gmail.com
password: 123
```

### Admin

```bash
email: admin@gmail.com
password: 123
```

### Staff

```bash
email: staf1@gmail.com
password: 123

email: staff2@gmail.com
password: 123
```

## Penggunaan

Setelah aplikasi berjalan, buka browser dan akses:

```bash
http://127.0.0.1:8000
```

Login menggunakan akun demo
Setelah masuk, anda dapat:

-   Mengelola data master (Produk, Supplier, Customer, Kategori)
-   Membuat transaksi masuk & keluar
-   Memeriksa log aktivitas
-   Melihat stok terkini dari setiap produk

## Demo

https://github.com/user-attachments/assets/1cd30665-e6f2-4e10-9570-2a4ec5fa4f7d


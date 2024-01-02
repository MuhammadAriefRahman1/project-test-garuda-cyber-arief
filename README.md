# Project Test Garuda Cyber

## Kandidat
- Nama: Muhammad Arief Rahman
- Email: arief21si@mahasiswa.pcr.ac.id
- No. HP: 081318782351

## Deskripsi
Sebuah aplikasi kasir sederhana untuk menginputkan produk yang dibeli dan menghitung total harga yang harus dibayar. Aplikasi ini memfasilitasi sistem voucher sesuai kriteria yang diberikan.

Voucher didapatkan apabila total pembelian melebihi batas yang ditentukan (Rp 2.000.000). Sebuah kode unik kemudian ditampilkan pada faktur pembelian. Kode unik ini dapat digunakan untuk mendapatkan potongan harga pada pembelian selanjutnya.

## Cara Menjalankan
1. Clone repository ini
2. Buka terminal dan arahkan ke folder repository ini
3. Jalankan perintah `composer install` untuk menginstall dependency
4. Jalankan sebuah server MySQL atau MariaDB dan konfigurasikan file `.env` apabila diperlukan
5. Lakukan migrasi database dengan perintah `php artisan migrate` dan tambahkan data untuk contoh tes dengan perintah `php artisan db:seed`
6. Jalankan perintah `php artisan serve` untuk menjalankan server

## Informasi Tambahan
- Ada 4 buah produk _static_ yang diinputkan menggunakan _seeder_ untuk contoh tes
- Project ini menggunakan library Bootstrap dan jQuery

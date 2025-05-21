<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Deskripsi Singkat Sistem
<h1>Sistem Monitoring Kehadiran Mahasiswa</h1>

Sistem Monitoring Kehadiran Mahasiswa adalah aplikasi berbasis web yang dirancang untuk memudahkan pengelolaan kehadiran mahasiswa. Sistem ini memungkinkan dosen, mahasiswa, dan admin untuk berinteraksi melalui antarmuka yang sederhana namun fungsional. Dengan sistem ini, pelacakan kehadiran menjadi lebih efisien dan transparan.


## Fitur Utama Sistem

1. Autentikasi dan Manajemen Pengguna<br>
Fitur ini berfungsi sebagai gerbang utama sistem, di mana pengguna harus melakukan proses login sebelum dapat mengakses aplikasi. Setiap pengguna akan memiliki akun dengan peran tertentu (seperti admin, dosen atau mahasiswa), dan hak akses ditentukan berdasarkan peran tersebut. Dengan autentikasi ini, keamanan data lebih terjaga karena tidak semua pengguna dapat melihat atau mengubah informasi yang bersifat sensitif. Selain login, pengguna juga dapat logout dengan aman, dan sistem dirancang untuk melindungi sesi pengguna agar tidak mudah disalahgunakan.

2. Dashboard Ringkasan Data<br>
Setelah berhasil login, pengguna akan diarahkan ke dashboard utama yang berfungsi sebagai pusat informasi. Dashboard ini menampilkan data penting dalam bentuk ringkasan, seperti jumlah total data yang tercatat, perkembangan grafik data. Semua informasi disusun secara visual agar mudah dipahami hanya dengan sekali lihat.

3. Manajemen Data (CRUD: Create, Read, Update, Delete)<br>
Melalui fitur ini, pengguna dapat menambahkan data baru melalui form input yang dilengkapi dengan validasi otomatis, membaca dan menelusuri daftar data dalam tabel yang rapi, mengedit informasi jika diperlukan, dan menghapus data yang sudah tidak relevan. Setiap aksi yang dilakukan pengguna akan langsung disimpan ke dalam sistem secara real-time. Fitur ini membantu menjaga agar seluruh data tetap terorganisir, akurat, dan selalu diperbarui sesuai kebutuhan operasional.

4. Pencarian dan Filter Data<br>
Fitur pencarian dan filter membantu pengguna dalam menavigasi data yang jumlahnya banyak. Pengguna dapat dengan mudah mencari data tertentu berdasarkan kata kunci, tanggal, status, atau kategori. Proses pencarian dirancang agar cepat dan efisien, sehingga pengguna tidak perlu menggulir halaman panjang atau membuka data satu per satu.


## Panduan Instalasi Laravel - SiMon Project
Panduan ini berisi langkah-langkah lengkap untuk menginstal dan menjalankan project Laravel secara lokal.<br>
✅ Pastikan semua persyaratan sistem terpenuhi
   - PHP ≥ 8.1  
   - Composer
   - MySQL / MariaDB 

## 🛠️ Langkah-langkah Instalasi

1. Clone Project (jika dari repository)
    ```bash
    git clone https://github.com/gerinnr/FrontEnd-SiMon.git
    cd simon
    ```
    Atau jika membuat project baru <br>
    ```
    composer create-project laravel/laravel simon
    cd simon
    ```

2. Install Dependency Backend
    ```
    composer install
    ```

3. Setup File Environment
   ```
   cp .env.example .env
    ```
4. Edit .env untuk menyesuaikan konfigurasi database:<br>

    ```
    APP_URL=http://localhost
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=simon_kehadiran
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. Jalankan Laravel Server
   ```
   php artisan serve
   ```
   Buka di browser:
🔗 http://localhost:8000



# Sistem Administrasi Desa (SiDesa)

**SiDesa** adalah aplikasi Sistem Informasi Desa berbasis Web yang dibangun menggunakan Framework Laravel. Aplikasi ini dirancang untuk mendigitalisasi dan memudahkan proses administrasi, pendataan warga, serta pelayanan publik di tingkat desa.

Aplikasi ini sangat cocok digunakan oleh Kepala Desa, Perangkat Desa (Sekretaris, Kaur, Kadus), maupun langsung oleh Warga setempat secara mandiri (melalui hak akses pengguna masing-masing).

---

## 🌟 Fitur Utama

Terdapat 8 (delapan) pilar fitur utama yang disediakan oleh SiDesa:

1. **Autentikasi dan Manajemen Pengguna (Role-based)**
   - Mendukung sistem masuk (*login*) dengan *role* spesifik: **Admin**, **Kepala Desa**, **Perangkat Desa**, dan **Warga**.
   - Manajemen akun profil dan hak akses sesuai dengan perannya masing-masing.

2. **Manajemen Data Penduduk dan Keluarga**
   - Pendataan menyeluruh Kartu Keluarga (KK) dan Nomor Induk Kependudukan (NIK).
   - Pengelolaan data demografi (nama, tanggal lahir, agama, pekerjaan, dsb).

3. **Layanan Surat-Menyurat Digital**
   - Warga dapat mengajukan permohonan berbagai jenis surat (misal: Surat Pengantar, Surat Keterangan Tidak Mampu, dsb) secara daring.
   - Perangkat Desa memverifikasi dan menyetujui ajuan surat melalui sistem.

4. **Pencatatan Sertifikat Tanah (Buku Tanah Desa)**
   - Mendokumentasikan kepemilikan lahan atau aset properti milik warga maupun kas desa.
   - Pencarian riwayat kepemilikan dan legalitas dokumen tanah.

5. **Sistem Layanan Pengaduan Warga**
   - Warga dapat melaporkan masalah (infrastruktur, keamanan, dsb) secara *real-time*.
   - Dilengkapi pelacakan status penanganan pengaduan (*Menunggu*, *Diproses*, *Selesai*).

6. **Transparansi Anggaran (Keuangan Desa)**
   - Publikasi rencana penerimaan dan pengeluaran dana desa agar mudah diakses publik.
   - Grafik realisasi vs anggaran tahunan pada dasbor utama.

7. **Manajemen Inventaris (Aset Desa)**
   - Pencatatan seluruh barang dan properti fasilitas umum milik instansi pemerintahan desa.
   - Pengawasan terhadap kondisi aset (Baik/Rusak).

8. **Papan Pengumuman Digital**
   - Penyebaran informasi, sosialisasi program, dan berita terbaru dari balai desa yang dapat langsung dilihat warga pada beranda aplikasi.

---

## 🚀 Panduan Instalasi (Lokal)

Ikuti langkah-langkah di bawah ini untuk menjalankan SiDesa pada mesin lokal (komputer) Anda:

### 1. Kloning Repositori
Buka terminal/Command Prompt dan jalankan perintah:
```bash
git clone https://github.com/auliasauzan/sistem-administrasi-desa.git
cd sistem-administrasi-desa
```

### 2. Instalasi Dependensi (Composer)
Pastikan Anda sudah menginstal PHP dan [Composer](https://getcomposer.org/).
```bash
composer install
```

### 3. Konfigurasi Lingkungan (.env)
Salin berkas konfigurasi *environment*:
```bash
cp .env.example .env
```
Lalu, buatlah basis data (database) kosong di MySQL/MariaDB (misalnya bernama `sidesa_db`).
Buka berkas `.env` yang baru saja disalin dan sesuaikan kredensial basis data Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sidesa_db
DB_USERNAME=root
DB_PASSWORD=
```
Jangan lupa *generate application key*:
```bash
php artisan key:generate
```

### 4. Migrasi dan Seeding Database
Jalankan migrasi tabel beserta *seeding* (data sampel bawaan) agar aplikasi siap digunakan.
```bash
php artisan migrate --seed
```

### 5. Jalankan Server Lokal
Nyalakan *development server* bawaan Laravel:
```bash
php artisan serve
```
Aplikasi kini dapat diakses melalui peramban (browser) di: `http://127.0.0.1:8000`.

---
*Dibuat untuk mempermudah tata kelola administrasi pemerintahan desa di era digital.*

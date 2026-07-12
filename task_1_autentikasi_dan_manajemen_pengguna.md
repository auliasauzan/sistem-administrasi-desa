# Task 1: Autentikasi dan Manajemen Pengguna

## Tujuan
Menyelaraskan sistem autentikasi dan manajemen pengguna (user management) yang sudah ada di Laravel agar sesuai dengan PRD.md, khususnya terkait peran pengguna (admin desa, perangkat desa, warga), dan menempatkan sistem login secara terpusat.

## Spesifikasi Teknis
1. **Penyesuaian Skema Database**:
   - Memodifikasi tabel `users` (atau perbarui skema role yang sudah ada) agar mendukung peran: `Admin Desa`, `Perangkat Desa`, dan `Warga`.
   - Modifikasi desain tabel `village_officials` agar berelasi langsung dengan tabel `users` menggunakan `user_id`. Hapus field `email` dan `password` pada tabel `village_officials` karena data login sepenuhnya bergantung pada tabel `users`.
2. **Pembuatan Seeder & Data Dummy**:
   - Buat/perbarui *Seeder* untuk *Role* dan *User*.
   - Hasilkan data dummy representatif untuk masing-masing role (minimal 1 Admin Desa, beberapa Perangkat Desa, dan beberapa Warga).
   - Pastikan setiap data `village_officials` dummy yang ter-generate juga memiliki akun di tabel `users`.
3. **Penyesuaian CRUD Manajemen Pengguna**:
   - Sesuaikan form Create, Read, Update, dan Delete (CRUD) pengguna agar mengenali dan memproses struktur role dan relasi yang baru.
   - Mengikuti secara ketat standar *coding style*, pola arsitektur, dan konvensi penamaan yang sudah ada (existing) pada modul user saat ini. **Tidak diperbolehkan membuat pola baru yang tidak konsisten**.

## Kriteria Penerimaan (Acceptance Criteria)
- [ ] Migrasi database berhasil dijalankan tanpa error dan relasi `users` ke `village_officials` terbentuk dengan benar (menggunakan `user_id`).
- [ ] Database seeder berhasil di-seed dan memunculkan data dummy lengkap untuk uji coba.
- [ ] Login menggunakan akun dummy masing-masing role berhasil dengan baik.
- [ ] Halaman manajemen pengguna menampilkan, dapat menambah, mengedit, dan menghapus pengguna beserta role-nya menggunakan gaya koding eksisting.

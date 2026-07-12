# Task 2: Manajemen Data Penduduk dan Keluarga

## Tujuan
Membuat fitur pengelolaan data Kartu Keluarga (`families`) dan Penduduk (`residents`) sesuai spesifikasi PRD.md.

## Spesifikasi Teknis
1. **Migrasi Database**:
   - Buat migrasi untuk tabel `families` (NKK, alamat, lingkungan, dll).
   - Buat migrasi untuk tabel `residents` (NIK, nama, tanggal lahir, jenis kelamin, agama, pekerjaan) dengan relasi *foreign key* `family_id` ke tabel `families`.
2. **Seeder & Data Dummy**:
   - Buat seeder menggunakan *Factory* untuk menghasilkan minimal 10 keluarga dan total 30-40 data penduduk.
3. **CRUD & Antarmuka**:
   - Terapkan standar koding dan UI yang seragam dengan sistem *existing*.
   - Buat fungsionalitas CRUD untuk Data Keluarga.
   - Buat fungsionalitas CRUD untuk Data Penduduk yang dapat dihubungkan ke data Keluarga.

## Kriteria Penerimaan
- [ ] Tabel `families` dan `residents` terbuat dengan relasi yang benar.
- [ ] Data dummy kependudukan sukses terisi lewat Seeder dan bisa divisualisasikan (dilihat pada tabel UI).
- [ ] Fitur Create, Read, Update, Delete untuk Keluarga dan Penduduk berfungsi sempurna.

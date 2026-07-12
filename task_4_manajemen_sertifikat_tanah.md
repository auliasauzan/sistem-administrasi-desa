# Task 4: Manajemen Sertifikat Tanah

## Tujuan
Mengembangkan fitur pencatatan dan manajemen buku persil/sertifikat tanah warga.

## Spesifikasi Teknis
1. **Migrasi Database**:
   - Buat migrasi untuk tabel `land_certificates` meliputi field nomor sertifikat, luas tanah, lokasi, dan `owner_id` (foreign key ke `residents`).
2. **Seeder & Data Dummy**:
   - Generate data dummy sertifikat tanah yang dihubungkan secara acak ke data penduduk di tabel `residents`.
3. **CRUD & Antarmuka**:
   - Halaman daftar sertifikat tanah dengan fitur filter dan pencarian.
   - Fitur tambah, ubah, dan hapus data sertifikat.

## Kriteria Penerimaan
- [ ] Migrasi berhasil dan relasi dengan tabel `residents` valid.
- [ ] Data dummy termuat dengan sukses untuk keperluan demonstrasi/visualisasi.
- [ ] Modul CRUD beroperasi dengan baik sesuai standar desain UI sistem.

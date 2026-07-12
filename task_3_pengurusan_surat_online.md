# Task 3: Pengurusan Surat Menyurat Online

## Tujuan
Membuat sistem pengelolaan permintaan surat menyurat bagi warga desa.

## Spesifikasi Teknis
1. **Migrasi Database**:
   - Buat migrasi untuk tabel `letter_types` (master jenis-jenis surat dan syaratnya).
   - Buat migrasi untuk tabel `letters` (data pengajuan surat) dengan relasi ke `residents` (pemohon), `letter_types`, dan `village_officials` (petugas pemeriksa).
2. **Seeder & Data Dummy**:
   - Buat seeder untuk beberapa jenis surat umum (contoh: SKTM, Pengantar Nikah, Surat Keterangan Usaha).
   - Generate data dummy transaksi pengajuan surat (`letters`) dengan berbagai status (pending, approved, rejected).
3. **CRUD & Proses Bisnis**:
   - UI untuk admin/petugas melihat daftar pengajuan dan mengubah status.
   - UI untuk warga melakukan permohonan surat baru.

## Kriteria Penerimaan
- [ ] Master jenis surat (`letter_types`) dapat dikelola (CRUD).
- [ ] Warga (dummy data user) dapat mengajukan surat.
- [ ] Perangkat Desa dapat memverifikasi, mengubah status surat, dan memberikan catatan.
- [ ] Terdapat data dummy yang siap untuk divisualisasikan pada view/halaman.

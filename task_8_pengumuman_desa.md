# Task 8: Pengumuman Desa

## Tujuan
Membuat mading digital tempat perangkat desa dapat mempublikasikan informasi atau pengumuman resmi ke masyarakat luas.

## Spesifikasi Teknis
1. **Migrasi Database**:
   - Buat migrasi untuk tabel `announcements` yang mencatat judul, konten, tanggal publikasi, dan `author_id` (foreign key ke `village_officials`).
2. **Seeder & Data Dummy**:
   - Buat seeder data pengumuman (dummy content berita/pemberitahuan kegiatan desa).
3. **CRUD & Antarmuka**:
   - Admin/Kades dapat mengelola pengumuman (Create, Read, Update, Delete).
   - Warga dapat melihat pengumuman terbaru di halaman utama/dashboard mereka.

## Kriteria Penerimaan
- [ ] Migrasi berhasil dan berelasi kuat dengan `village_officials`.
- [ ] Data dummy pengumuman telah dibuat dan tampil rapi pada interface portal desa.
- [ ] CRUD berjalan lancar dengan hak akses *Authoring* yang sesuai.

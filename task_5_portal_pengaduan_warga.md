# Task 5: Portal Pengaduan Warga

## Tujuan
Membuat fitur yang memungkinkan warga untuk menyampaikan keluhan/pengaduan yang kemudian dapat ditindaklanjuti oleh perangkat desa.

## Spesifikasi Teknis
1. **Migrasi Database**:
   - Buat migrasi untuk tabel `complaints` yang menyimpan data pengaduan (judul, deskripsi, foto/URL bukti) dengan relasi `resident_id` (pelapor) dan `handled_by` (petugas yang menangani dari tabel `village_officials`).
2. **Seeder & Data Dummy**:
   - Generate seeder untuk dummy pengaduan warga dengan berbagai status penyelesaian (`open`, `in_progress`, `resolved`).
3. **CRUD & Antarmuka**:
   - Form pembuatan keluhan baru khusus untuk login warga.
   - Halaman daftar pengaduan untuk perangkat desa yang dapat memantau, membalas, dan mengubah status laporan.

## Kriteria Penerimaan
- [ ] Tabel `complaints` berhasil direlasikan ke `residents` dan `village_officials`.
- [ ] Data dummy pengaduan muncul dan dapat ditampilkan di view dengan rapi.
- [ ] Modul berjalan sesuai alur: Warga lapor -> Perangkat Desa menangani -> Status berubah.

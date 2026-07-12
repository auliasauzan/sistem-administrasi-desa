# Task 6: Manajemen Anggaran Desa

## Tujuan
Mengembangkan fitur pencatatan dan transparansi anggaran (APBD Desa) baik pemasukan maupun pengeluaran.

## Spesifikasi Teknis
1. **Migrasi Database**:
   - Buat migrasi untuk tabel `budgets` yang menyimpan jenis anggaran (income/expense), kategori, deskripsi, nominal, dan tahun anggaran.
2. **Seeder & Data Dummy**:
   - Buat seeder data dummy simulasi RAPBDes dengan entri-entri logis (contoh: Pemasukan dari Dana Desa, Pengeluaran untuk Pembangunan Jalan).
3. **CRUD & Visualisasi**:
   - Fasilitas admin untuk menambah/mengedit data anggaran.
   - *View* khusus warga (publik) untuk melihat ringkasan transparansi anggaran (hanya *Read*).

## Kriteria Penerimaan
- [ ] Tabel `budgets` berfungsi dengan baik dan migrasi berhasil.
- [ ] Tersedia data dummy yang merepresentasikan neraca anggaran secara realistis.
- [ ] CRUD untuk Perangkat Desa bekerja dengan baik dan warga dapat melihat transparansi anggaran.

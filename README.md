

#  README Uji Coba Aplikasi
# Nama: Hanum Zaqiah Permatasari
# NIM: 202210370311125
# Kelas: Rekayasa Kebutuhan A

**Sistem Pelacakan Alumni**

---

##  1. Informasi Login (Uji Coba)

| Keterangan | Detail                                   |
| ---------- | ---------------------------------------- |
| Username   | admin                                    |
| Password   | admin                                    |
| Catatan    | Digunakan khusus untuk uji coba aplikasi |

---

##  2. Fitur & Pengujian Aplikasi

| No | Fitur                | Deskripsi                                                                                    | Cara Uji                | Hasil yang Diharapkan                  |
| -- | -------------------- | -------------------------------------------------------------------------------------------- | ----------------------- | -------------------------------------- |
| 1  | Dashboard            | Menampilkan jumlah alumni berdasarkan status (Terdeteksi, Perlu Verifikasi, Tidak Ditemukan) | Login → masuk dashboard | Data statistik tampil sesuai database  |
| 2  | Import Data Excel    | Data alumni dari file Excel dimasukkan ke sistem                                             | Import file Excel       | Data alumni berhasil masuk ke database |
| 3  | Data Alumni          | Menampilkan daftar alumni                                                                    | Klik menu Alumni        | Data tampil dalam tabel                |
| 4  | Tambah Alumni        | Menambahkan data alumni baru                                                                 | Klik "Tambah Alumni"    | Form input tampil                      |
| 5  | Form Alumni          | Input data alumni (nama, NIM, tahun masuk, tanggal lulus)                                    | Isi form                | Data tersimpan                         |
| 6  | Dropdown Tahun Masuk | Memilih tahun masuk                                                                          | Klik dropdown           | Tahun bisa dipilih                     |
| 7  | Input Tanggal Lulus  | Format tanggal (MM/DD/YY)                                                                    | Pilih tanggal           | Data tersimpan dengan format benar     |
| 8  | Edit Alumni          | Mengubah data alumni                                                                         | Klik edit               | Data berubah                           |
| 9  | Hapus Alumni         | Menghapus data alumni                                                                        | Klik hapus              | Data terhapus                          |
| 10 | Pelacakan Alumni     | Mencari data alumni dari berbagai platform                                                   | Klik menu Pelacakan     | Form pelacakan tampil                  |
| 11 | Integrasi Pencarian  | Otomatis mencari ke Google, LinkedIn, Scholar, dll                                           | Klik nama alumni        | Link pencarian terbuka                 |
| 12 | Fitur Lacak          | Menghitung persentase kecocokan alumni                                                       | Klik tombol "Lacak"     | Persentase muncul                      |
| 13 | Hasil Pelacakan      | Menampilkan hasil pencarian alumni                                                           | Klik menu Hasil         | Data hasil tampil                      |
| 14 | Link Sosial Media    | Menampilkan link LinkedIn, IG, FB, TikTok                                                    | Buka hasil pelacakan    | Link otomatis tersedia                 |
| 15 | Tambah Hasil         | Menambahkan data hasil pelacakan                                                             | Input data              | Data tersimpan                         |
| 16 | Edit Hasil           | Mengubah data hasil pelacakan                                                                | Klik edit               | Data berubah                           |
| 17 | Hapus Hasil          | Menghapus hasil pelacakan                                                                    | Klik hapus              | Data terhapus                          |
| 18 | Pencarian Data       | Mencari alumni di hasil pelacakan                                                            | Gunakan search          | Data ditemukan                         |
| 19 | Logout               | Keluar dari sistem                                                                           | Klik logout             | Kembali ke login                       |

---

##  3. Ringkasan Sistem

| Aspek        | Keterangan                                     |
| ------------ | ---------------------------------------------- |
| Jenis Sistem | Sistem Pelacakan Alumni                        |
| Platform     | Web                                            |
| Database     | MySQL                                          |
| Fitur Utama  | CRUD Alumni, Pelacakan, Hasil Pelacakan        |
| Integrasi    | Google, LinkedIn, Google Scholar, Media Sosial |
| Status       | Siap digunakan untuk uji coba                  |

---

##  4. Kesimpulan Uji Coba

| Keterangan      | Hasil               |
| --------------- | ------------------- |
| Login           | Berhasil            |
| CRUD Alumni     | Berfungsi           |
| Import Data     | Berhasil            |
| Pelacakan       | Berfungsi           |
| Hasil Pelacakan | Tampil dengan benar |
| Pencarian       | Berfungsi           |
| Logout          | Berhasil            |

---

##  Catatan

* Sistem sudah dapat digunakan untuk **pengujian fungsional**
* Data dapat ditambah, diubah, dan dihapus dengan baik
* Fitur pelacakan membantu identifikasi alumni melalui berbagai platform


Siap 👍
Berikut **README.md profesional** yang **rapi, jelas, dan cocok untuk tugas UAS**, sekaligus **layak dipajang di GitHub**.
Bahasanya formal tapi tetap mudah dipahami dosen.

---

# 🗑️ Aplikasi Manajemen Bank Sampah

**Tugas UAS – Pemrograman Web Lanjut**
Program Studi **S1 Teknologi Informasi – Semester 5**

---

## 📌 Deskripsi Aplikasi

Aplikasi **Manajemen Bank Sampah** adalah sistem berbasis web yang digunakan untuk mengelola proses **setor sampah**, **pengelolaan nasabah**, **petugas**, **jenis sampah**, serta **laporan transaksi**.
Aplikasi ini dibangun menggunakan **Laravel** sebagai implementasi konsep **Pemrograman Web Lanjut** seperti MVC, autentikasi, relasi database, dan manajemen data dinamis.

---

## 🎯 Tujuan Pembuatan

* Memenuhi **Tugas Ujian Akhir Semester (UAS)** mata kuliah **Pemrograman Web Lanjut**
* Mengimplementasikan konsep:

  * MVC (Model–View–Controller)
  * Autentikasi & Authorization
  * Relasi database
  * Validasi data
  * CRUD (Create, Read, Update, Delete)
* Membuat sistem nyata yang relevan dengan permasalahan lingkungan

---

## 🧩 Fitur Aplikasi

### 🔐 Autentikasi & Role

* Login menggunakan **username atau email**
* Role pengguna:

  * **Admin**
  * **Petugas**
  * **Nasabah**

### 👥 Manajemen Pengguna

* Data Admin
* Data Petugas
* Data Nasabah

### 🗑️ Manajemen Sampah

* Tambah, ubah, hapus jenis sampah
* Harga per kilogram
* Status aktif/nonaktif

### ♻️ Transaksi Setor Sampah

* Input transaksi setor sampah
* Petugas otomatis tercatat sesuai user login
* Perhitungan berat & poin

### 📊 Dashboard

* Total nasabah
* Total petugas
* Total transaksi setor sampah
* Grafik setoran sampah bulanan

### 📑 Laporan

* Filter berdasarkan:

  * Tanggal
  * Nasabah
  * Jenis sampah
* Rekap total berat & poin

---

## 🛠️ Teknologi yang Digunakan

| Teknologi  | Keterangan              |
| ---------- | ----------------------- |
| Laravel    | Framework Backend (PHP) |
| PHP        | Bahasa Pemrograman      |
| MySQL      | Database                |
| Blade      | Template Engine         |
| Bootstrap  | UI Framework            |
| Chart.js   | Grafik                  |
| JavaScript | Interaksi Frontend      |

---

## 🗃️ Struktur Database (Ringkas)

* **users**
* **profiles**
* **sampah**
* **setor_sampah**

Relasi utama:

* User (nasabah) ➝ Setor Sampah
* User (petugas) ➝ Setor Sampah
* Sampah ➝ Setor Sampah

---

## 🚀 Cara Menjalankan Aplikasi

### 1️⃣ Clone Repository

```bash
git clone https://github.com/username/bank-sampah.git
cd bank-sampah
```

### 2️⃣ Migrasi & Seeder

```bash
php artisan migrate --seed
```

### 3️⃣ Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di:

```
http://127.0.0.1:8000
```

---

## 🔑 Akun Default (Seeder)

| Role    | Username   | Password |
| ------- | ---------- | -------- |
| Admin   | superadmin | admin123 |
| Petugas | petugas1   | petugas123 |

---

## 📂 Struktur Folder Penting

```text
app/
 ├── Models/
 ├── Http/Controllers/
resources/
 ├── views/
database/
 ├── migrations/
 ├── seeders/
routes/
 ├── web.php
```

---

## 📚 Materi yang Diimplementasikan (Sesuai PWL)

* Laravel MVC
* Authentication & Session
* Middleware & Role
* Validation Request
* Eloquent ORM
* Migration & Seeder
* Relasi Database
* Blade Template
* Chart.js Integration

---

## 👨‍🎓 Identitas Mahasiswa

* **Nama**   : *Fahmi Bahrul Widad*
* **NIM**    : *2321500018*
* **Prodi**  : S1 Teknologi Informasi
* **Semester** : 5
* **Mata Kuliah** : Pemrograman Web Lanjut

---

## 📝 Penutup

Aplikasi ini dikembangkan sebagai bentuk penerapan konsep **Pemrograman Web Lanjut** dalam studi kasus nyata **Manajemen Bank Sampah**.
Diharapkan aplikasi ini dapat menjadi referensi pembelajaran sekaligus solusi digital sederhana yang bermanfaat.

---

📌 **Catatan**
Project ini dibuat untuk keperluan **akademik (UAS)**.

---
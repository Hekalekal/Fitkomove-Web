# Fitkomove

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/Chart.js-4.4-FF6384?style=for-the-badge&logo=chartdotjs&logoColor=white" alt="Chart.js">
</p>

**Fitkomove** adalah aplikasi web pelacak kebugaran (fitness tracker) yang dirancang untuk membantu pengguna memantau perjalanan fitness mereka. Aplikasi ini menyediakan fitur-fitur lengkap untuk mencatat aktivitas fisik, menghitung BMI, mengatur jadwal olahraga, dan mendapatkan rekomendasi yang dipersonalisasi.

---

## Overview

Fitkomove memungkinkan pengguna untuk:
- Melacak berbagai jenis aktivitas fisik seperti lari, bersepeda, dan workout
- Memantau perkembangan melalui grafik dan statistik mingguan
- Menghitung dan memantau Body Mass Index (BMI)
- Mengatur jadwal olahraga dan pengingat
- Mendapatkan rekomendasi olahraga dan makanan sehat berdasarkan profil pengguna

---

## Fitur

### 1. Manajemen Profil Pengguna
- Edit data profil (nama, tanggal lahir, usia, gender, pekerjaan)
- Upload foto profil
- Input data fisik (tinggi badan, berat badan, target berat)
- Pengaturan tujuan fitness dan intensitas latihan

### 2. Pelacakan Aktivitas Fisik (CRUD)
- Catat berbagai jenis aktivitas: Running, Cycling, Walking, Swimming, Workout, Yoga, HIIT, dan lainnya
- Input detail aktivitas: durasi, jarak, kalori terbakar, catatan
- Lihat riwayat aktivitas dengan filter dan pencarian
- Edit dan hapus aktivitas yang sudah tercatat

### 3. Dashboard Aktivitas
- Grafik perkembangan aktivitas mingguan menggunakan Chart.js
- Statistik ringkasan: total kalori, durasi, dan jumlah aktivitas
- Tampilan aktivitas terbaru
- Rekomendasi olahraga berdasarkan level dan tujuan pengguna

### 4. Kalkulator BMI & Rekomendasi
- Perhitungan BMI otomatis berdasarkan tinggi dan berat badan
- Kategorisasi BMI (Underweight, Normal, Overweight, Obese)
- Rekomendasi olahraga yang disesuaikan dengan kategori BMI
- Rekomendasi makanan sehat berdasarkan tujuan fitness

### 5. Jadwal Olahraga (CRUD)
- Buat jadwal olahraga harian/mingguan
- Atur waktu dan jenis aktivitas
- Tandai jadwal sebagai selesai
- Lihat jadwal hari ini di dashboard

### 6. Sistem Pengingat/Alert (CRUD)
- Buat pengingat untuk olahraga dan istirahat
- Berbagai jenis pengingat: workout, rest, hydration, meal, sleep
- Notifikasi browser untuk pengingat
- Kelola pengingat aktif dan nonaktif

### 7. Mode Guest (Demo)
- Akses demo dashboard tanpa perlu login
- Preview semua fitur dengan data contoh
- Ajakan untuk mendaftar dan menyimpan data

### 8. Dark Mode
- Toggle dark/light mode
- Preferensi tersimpan di localStorage
- Mengikuti preferensi sistem secara otomatis
- Desain yang accessible dan nyaman di mata

---

## Tech Stack

### Backend
| Teknologi | Versi | Deskripsi |
|-----------|-------|-----------|
| **PHP** | 8.2+ | Bahasa pemrograman server-side |
| **Laravel** | 11.x | Framework PHP untuk web application |
| **MySQL/SQLite** | - | Database relasional |
| **Eloquent ORM** | - | Object-Relational Mapping Laravel |

### Frontend
| Teknologi | Versi | Deskripsi |
|-----------|-------|-----------|
| **Bootstrap** | 5.3.2 | CSS framework untuk responsive design |
| **Bootstrap Icons** | 1.11.1 | Library ikon |
| **Chart.js** | 4.4.1 | Library untuk visualisasi data/grafik |
| **Google Fonts (Inter)** | - | Typography |

### Tools & Libraries
| Teknologi | Deskripsi |
|-----------|-----------|
| **Blade** | Template engine Laravel |
| **Laravel Breeze** | Authentication scaffolding |
| **Vite** | Build tool dan asset bundler |
| **Composer** | PHP dependency manager |
| **NPM** | JavaScript package manager |

---

## Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL atau SQLite

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/username/fitkomove.git
   cd fitkomove
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database**
   
   Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=fitkomove
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan migrasi**
   ```bash
   php artisan migrate
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Jalankan server**
   ```bash
   php artisan serve
   ```

8. **Akses aplikasi**
   
   Buka browser dan akses `http://localhost:8000`

---

## Struktur Direktori

```
fitkomove/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── DashboardController.php
│   │       ├── ActivityController.php
│   │       ├── ScheduleController.php
│   │       └── ReminderController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Activity.php
│   │   ├── Schedule.php
│   │   └── Reminder.php
│   └── Policies/
├── database/
│   └── migrations/
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── dashboard.blade.php
│       ├── welcome.blade.php
│       ├── activities/
│       ├── schedules/
│       └── reminders/
└── routes/
    └── web.php
```

---

## Screenshot

### Landing Page
Halaman utama dengan informasi fitur dan ajakan untuk mendaftar.

### Dashboard
Dashboard utama dengan statistik, grafik aktivitas, dan rekomendasi.

### Dark Mode
Tampilan dark mode yang nyaman untuk penggunaan malam hari.

---

## Credits

Proyek ini dikembangkan oleh tim sebagai tugas akhir mata kuliah Pemrograman Web.

### Tim Pengembang

| Nama | Kontribusi |
|------|------------|
| **Arken** | Developer |
| **Ghozali Habibie** | Developer |
| **Muhammad Haikal Muttaqien** | Developer |
| **Riva Ramadani Puteri** | Developer |
| **Thevan Erlangga** | Developer |

---

## License

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

<p align="center">
  Made with ❤️ by Fitkomove Team
</p>
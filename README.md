# 🏃‍♂️ Fitkomove

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/Chart.js-4.4-FF6384?style=for-the-badge&logo=chartdotjs&logoColor=white" alt="Chart.js">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
</p>

<p align="center">
  <strong>🎯 Aplikasi Web Fitness Tracker Modern untuk Memantau Perjalanan Kebugaran Anda</strong>
</p>

---

## 📖 Tentang Fitkomove

**Fitkomove** adalah aplikasi web pelacak kebugaran (fitness tracker) yang dirancang untuk membantu pengguna memantau perjalanan fitness mereka secara komprehensif. Dibangun dengan teknologi modern dan antarmuka yang intuitif, Fitkomove menyediakan fitur-fitur lengkap untuk mencatat aktivitas fisik, menghitung BMI, mengatur jadwal olahraga, dan mendapatkan rekomendasi yang dipersonalisasi berdasarkan profil pengguna.

### ✨ Mengapa Fitkomove?

- 🎨 **Desain Modern** - UI/UX yang bersih, responsif, dan mendukung dark mode
- 📊 **Visualisasi Data** - Grafik interaktif untuk memantau progress
- 🤖 **Rekomendasi Cerdas** - Saran olahraga & nutrisi berdasarkan profil
- 📅 **Kalender Interaktif** - Lihat rekomendasi olahraga harian dengan ikon
- 🔔 **Sistem Pengingat** - Notifikasi browser untuk jadwal olahraga
- 👻 **Mode Guest** - Coba semua fitur tanpa perlu registrasi

---

## 🌟 Fitur Utama

### 1. 👤 Manajemen Profil Pengguna
- Edit data profil lengkap (nama, tanggal lahir, usia, gender, pekerjaan)
- Upload dan kelola foto profil
- Input data fisik (tinggi badan, berat badan, target berat)
- Pengaturan tujuan fitness (weight loss, muscle gain, maintenance, endurance)
- Pilihan intensitas latihan (low, medium, high)
- Custom date picker untuk tanggal lahir dengan dropdown tahun

### 2. 🏋️ Pelacakan Aktivitas Fisik (CRUD)
- Catat berbagai jenis aktivitas:
  - 🏃 **Running** - Lari
  - 🚴 **Cycling** - Bersepeda
  - 🚶 **Walking** - Jalan Kaki
  - 🏊 **Swimming** - Berenang
  - 💪 **Workout** - Latihan Umum
  - 🧘 **Yoga** - Yoga
  - ⚡ **HIIT** - High-Intensity Interval Training
  - 🏋️ **Strength** - Strength Training
- Input detail aktivitas: durasi, jarak, kalori terbakar, pace, detak jantung
- Kalkulasi kalori otomatis berdasarkan jenis aktivitas dan durasi
- Riwayat aktivitas dengan filter dan pencarian
- Custom date/time picker dengan desain modern

### 3. 📊 Dashboard Interaktif
- **Statistik Ringkasan** - Total kalori, durasi, dan jumlah aktivitas minggu ini
- **Grafik Progress** - Visualisasi aktivitas mingguan dengan Chart.js
- **Kalender Bulanan** - Tampilan kalender dengan ikon rekomendasi olahraga harian
- **Legenda Olahraga** - Keterangan nama olahraga untuk setiap ikon di kalender
- **Aktivitas Terbaru** - Daftar aktivitas yang baru dicatat
- **Jadwal Hari Ini** - Reminder jadwal olahraga hari ini

### 4. 📏 Kalkulator BMI & Rekomendasi
- Perhitungan BMI otomatis berdasarkan tinggi dan berat badan
- Kategorisasi BMI dengan indikator visual:
  - 🔵 **Underweight** (< 18.5)
  - 🟢 **Normal** (18.5 - 24.9)
  - 🟡 **Overweight** (25 - 29.9)
  - 🔴 **Obese** (≥ 30)
- Rekomendasi olahraga yang disesuaikan dengan kategori BMI
- Saran makanan sehat berdasarkan tujuan fitness
- Progress bar menuju target berat badan

### 5. 📅 Jadwal Olahraga (CRUD)
- Buat jadwal olahraga dengan tanggal dan waktu spesifik
- Pilih jenis aktivitas yang akan dijadwalkan
- Atur durasi latihan yang direncanakan
- Status jadwal: Pending, Completed, Skipped
- Tampilan jadwal hari ini di dashboard
- Custom date/time picker untuk input jadwal

### 6. 🔔 Sistem Pengingat (CRUD)
- Berbagai jenis pengingat:
  - 💪 **Workout** - Pengingat olahraga
  - 😴 **Rest** - Pengingat istirahat
  - 💧 **Hydration** - Pengingat minum air
  - 🍽️ **Meal** - Pengingat makan
  - 🎯 **Custom** - Pengingat kustom
- Atur hari aktif pengingat (Senin-Minggu)
- Toggle aktif/nonaktif pengingat
- Notifikasi browser untuk pengingat
- Custom time picker untuk waktu pengingat

### 7. 👻 Mode Guest (Demo)
- Akses demo dashboard tanpa perlu login/registrasi
- Preview semua fitur dengan data contoh
- Statistik dan grafik demo yang interaktif
- Call-to-action untuk mendaftar dan menyimpan data

### 8. 🌙 Dark Mode
- Toggle dark/light mode dengan satu klik
- Preferensi tersimpan di localStorage
- Deteksi otomatis preferensi sistem operasi
- Transisi smooth antar mode
- Desain yang accessible dan nyaman di mata

### 9. 🎨 Custom UI Components
- **Flatpickr Date/Time Picker** - Picker tanggal dan waktu dengan desain custom
- **Responsive Navigation** - Navbar yang adaptif untuk semua ukuran layar
- **Card Components** - Kartu dengan shadow dan border radius modern
- **Form Styling** - Input dengan ikon dan styling konsisten
- **Loading States** - Animasi loading yang smooth

---

## 🛠️ Tech Stack

### ⚙️ Backend
| Teknologi | Versi | Deskripsi |
|-----------|-------|-----------|
| **PHP** | 8.2+ | Bahasa pemrograman server-side |
| **Laravel** | 11.x | Framework PHP modern dengan fitur lengkap |
| **MySQL** | 8.0 | Database relasional untuk penyimpanan data |
| **Eloquent ORM** | - | Object-Relational Mapping bawaan Laravel |
| **Laravel Breeze** | - | Authentication scaffolding yang ringan |

### 🎨 Frontend
| Teknologi | Versi | Deskripsi |
|-----------|-------|-----------|
| **Bootstrap** | 5.3.2 | CSS framework untuk responsive design |
| **Bootstrap Icons** | 1.11.1 | Library ikon SVG yang lengkap |
| **Chart.js** | 4.4.1 | Library untuk visualisasi data/grafik interaktif |
| **Flatpickr** | Latest | Custom date/time picker yang modern |
| **Google Fonts** | Inter | Typography modern dan readable |

### 🔧 Tools & Libraries
| Teknologi | Deskripsi |
|-----------|-----------|
| **Blade** | Template engine bawaan Laravel |
| **Vite** | Build tool dan asset bundler yang cepat |
| **Composer** | PHP dependency manager |
| **NPM** | JavaScript package manager |
| **Git** | Version control system |

---

## 📦 Instalasi

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

## 📁 Struktur Direktori

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

## 📸 Screenshot

### Landing Page
Halaman utama dengan informasi fitur dan ajakan untuk mendaftar.

### Dashboard
Dashboard utama dengan statistik, grafik aktivitas, dan rekomendasi.

### Dark Mode
Tampilan dark mode yang nyaman untuk penggunaan malam hari.

---

## 👥 Credits

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

## 📄 License

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

<p align="center">
  Made with ❤️ by Fitkomove Team
</p># Fitkomove-Web

# Sakeenah Medicare (SKMED) - Platform Pengurusan Klinik & Kesihatan Mental

Platform web rasmi dan sistem portal pengurusan pentadbiran klinik psikologi dan terapi **Sakeenah Medicare** yang beroperasi di Cyberjaya, Malaysia. Dibina menggunakan Laravel 13, Tailwind CSS v4, dan pangkalan data SQLite/MySQL.

---

## 🌟 Ciri-Ciri Utama Sistem

### 1. Laman Awam (Public Portal)
- **Halaman Utama (Landing Page):** Pengenalan perkhidmatan klinikal, direktori pakar/terapis, artikel psikoedukasi, dan testimoni.
- **Sistem Tempahan Janji Temu (Online Booking Flow):**
  - Pemilihan perkhidmatan (Diagnostik, Kaunseling, Terapi Kanak-kanak / Dewasa / Pasangan).
  - Pemilihan mod sesi: **Bersemuka di Klinik (Physical)** atau **Dalam Talian (Online Tele-therapy)**.
  - Kalendar interaktif untuk pemilihan slot masa pakar (mengambil kira cuti dan hari bekerja pakar).
  - Muat naik resit bayaran deposit terus ke sistem dengan kod tempahan unik (`SKM-XXXXXX`).
  - Butang segera tambah acara ke **Google Calendar** atau muat turun fail kalendar `.ics`.
- **Ujian Saringan Minda (DASS-21 Self-Assessment):**
  - 21 soalan saringan emosi (Depression, Anxiety, Stress).
  - Pengiraan skor automatik mengikut skala keterukan piawai (*Normal, Ringan, Sederhana, Teruk, Sangat Teruk*).
  - Penghantaran salinan keputusan terus ke WhatsApp/emel klien dan rekod staf.

### 2. Portal Pentadbiran Staf (Admin Portal)
- **Papan Pemuka (Dashboard):** Ringkasan statistik tempahan, tindakan segera, pintasan pantas, dan status saringan terkini.
- **Pengurusan Tempahan Temu Janji:**
  - Senarai penuh tempahan pesakit dengan penapis status (*Perlu Tindakan, Disahkan, Selesai, Batal*).
  - Semakan slip deposit, pengesahan slot masa, penjanaan pautan Google Meet, dan notifikasi WhatsApp terus kepada pesakit.
- **Penyelarasan Google Calendar (Google Calendar Sync):**
  - Integrasi membaca acara dari Google Calendar klinik melalui pautan *Secret address in iCal format*.
  - Butang **"Segerak Sekarang (Sync Now)"** untuk penyelarasan manual.
  - **Auto-Sync Setiap 1 Jam** melalui Laravel Task Scheduler.
  - Penapis carian teks, penapis tarikh tunggal (*Single Date*), dan julat tarikh (*Date Range*).
  - Pembersihan automatik kod panggilan Google Meet antarabangsa (*boilerplate cleaner*) bagi memastikan catatan klinikal kekal kemas.
  - Halaman perincian penuh bagi setiap temujanji Google Calendar.
- **Pengurusan Pakar & Terapis (Practitioners):**
  - Maklumat tauliah, biografi, mod sesi, penetapan hari bekerja/cuti mingguan, dan tarikh sekatan cuti tahunan (*blocked dates*).
- **Katalog Perkhidmatan (Services):** Tambah, kemaskini, dan kawal harga pakej terapi serta kadar deposit.
- **Artikel & Blog Psikoedukasi:** Sistem penerbitan artikel kesihatan mental dengan sokongan imej sampul dan tag topik.
- **Respons Saringan DASS-21:** Rekod pesakit yang menjalani ujian saringan dengan carian dan filter tahap keterukan.

---

## 🛠️ Keperluan Sistem & Teknologi

- **PHP:** 8.4+
- **Composer:** 2.x
- **Node.js:** 20+ & npm
- **Pangkalan Data:** SQLite (pembangunan tempatan) / MySQL / PostgreSQL
- **Rangka Kerja:** Laravel 13.x
- **Penggayaan UI:** Tailwind CSS v4 & Alpine.js
- **Aset Fon:** Plus Jakarta Sans (Hos Tempatan melalui `@fontsource/plus-jakarta-sans`)

---

## 🚀 Panduan Pemasangan Tempatan (Local Setup)

### 1. Klon Repositori & Pasang Ketergantungan
```bash
git clone <URL_REPOSITORI>
cd clinic-website

# Pasang ketergantungan PHP
composer install

# Pasang ketergantungan JavaScript/CSS
npm install
```

### 2. Konfigurasi Persekitaran (`.env`)
Salin fail konfigurasi sampel:
```bash
cp .env.example .env
php artisan key:generate
```

Tetapkan konfigurasi pangkalan data dan pembolehubah penting dalam `.env`:
```env
APP_NAME="Sakeenah Medicare"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite

# Integrasi Google Calendar (Pilihan tetapi disyorkan)
# Dapatkan di: Google Calendar -> Settings -> Integrate Calendar -> Secret address in iCal format
GOOGLE_CALENDAR_ICAL_URL="https://calendar.google.com/calendar/ical/your_calendar_id/private-token/basic.ics"
```

### 3. Migrasi Pangkalan Data & Seeder
```bash
# Jalankan migrasi dan isi data awal (staf pentadbir, pakar, pakej rawatan, dan artikel)
php artisan migrate --seed
```

> **Akaun Staf Pentadbir Lalai:**
> - **Emel:** `admin@sakeenahmedicare.com`
> - **Kata Laluan:** `password`
> - **Pautan Log Masuk:** `http://localhost:8000/admin/login`

### 4. Kompilasi Aset Frontend
```bash
# Pembangunan
npm run dev

# Atau binaan produksi
npm run build
```

### 5. Menjalankan Aplikasi
```bash
php artisan serve
```
Laman web kini boleh diakses di `http://localhost:8000`.

---

## ⏰ Penjadualan Auto-Sync Google Calendar

Untuk membolehkan fungsi auto-sync Google Calendar berjalan setiap 1 jam, pastikan Laravel Scheduler aktif di server anda:

**Secara Tempatan (Local Testing):**
```bash
# Uji arahan sync sekali
php artisan google-calendar:sync

# Atau jalankan scheduler worker secara berterusan
php artisan schedule:work
```

**Di Persekitaran Server / Pengeluaran (Production Crontab):**
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

---

## 🧪 Pengujian & Piawaian Kod

Projek ini dilengkapi dengan set ujian automatik yang komprehensif (PHPUnit):

```bash
# Menjalankan keseluruhan ujian suite
php artisan test --compact

# Memeriksa dan membetulkan format kod mengikut piawaian Laravel Pint
vendor/bin/pint --format agent
```

---

## 📄 Lesen & Hak Cipta

Hak Cipta Terpelihara © 2026 **Sakeenah Medicare**.
Pembangunan sistem berasaskan kerangka kerja Laravel di bawah lesen MIT.

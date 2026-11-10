# Kajian Laman Web Sakeenah Medicare (sakeenahmedicare.net) & Pelan Cadangan Pembangunan Semula (Re-development Proposal)

---

## 1. Kajian & Audit Laman Web Semasa (Current State Audit)

### 1.1 Latar Belakang Entiti
* **Nama Entiti:** Sakeenah Medicare (SKMED) – Psychology & Wellness Center.
* **Lokasi Fizikal:** P3-03, Shaftsbury Square, Persiaran Multimedia, Cyber 6, 63000 Cyberjaya, Selangor.
* **Fokus Utama:** Kesihatan mental, terapi psikologi kanak-kanak, remaja, dewasa, pasangan & keluarga, penilaian diagnostik (ADHD, ASD, IQ, dsb.), terapi cara kerja (Occupational Therapy), terapi pertuturan (Speech Therapy), serta program korporat / Employee Assistance Programme (EAP).

### 1.2 Penemuan & Isu Utama di Laman Web Sedia Ada
1. **CMS & Struktur URL Tidak Terurus:**
   * Dibina menggunakan WordPress di pelayan LiteSpeed PHP.
   * Struktur URL tidak kemas dan menunjukkan sisa templat lama, contohnya:
     * `/psychologist-selangor/our-services-2/psychological-assessment/`
     * `/psychologist-selangor/our-team/`
     * `/psychologist-selangor/shop/`
     * Masih wujud pautan asas yang tidak dipadam seperti `/sample-page/`.
2. **Ketiadaan Sistem Tempahan Terus (No Direct Booking System):**
   * Pelawat hanya diberikan butang *"Whatsapp Us Now"*.
   * Tiada pilihan pemilihan slot masa dan tarikh secara automatik. Ini melambatkan pengesahan tempahan, memerlukan semakan manual staf, dan kerap berlaku risiko pertindihan jadual (*double booking*).
3. **Penyalahgunaan Modul E-Commerce (WooCommerce):**
   * Terdapat halaman kedai (`/shop/`, `/cart/`, `/checkout/`, `/my-account/`) yang diaktifkan tetapi tidak digunakan dengan betul untuk pembelian pakej terapi atau produk mental wellness.
4. **Strategi Kandungan & SEO Kurang Optimum:**
   * Hanya mempunyai 4 artikel blog bertarikh lama. Tiada carian berasaskan simptom (cth: "Tanda-tanda ADHD pada anak", "Simptom Burnout"), menyebabkan potensi trafik organik dari Google (SEO tempatan Cyberjaya/Putrajaya/Klang Valley) hilang.
5. **Ketiadaan Saringan Awal Interaktif (Self-Assessment Screener):**
   * Pelawat yang teragak-agak atau belum pasti jenis bantuan yang mereka perlukan tidak mempunyai alat panduan pantas (seperti ujian DASS-21 atau soal selidik pra-sesi).

---

## 2. Pelan Cadangan Pembangunan Semula (Re-Development Plan)

### 2.1 Matlamat Pembangunan Semula
1. **Meningkatkan Kadar Penukaran Klien (Conversion Rate):** Mengubah pelawat laman web kepada sesi temu janji berbayar dengan aliran yang ringkas dan mesra pengguna.
2. **Reka Bentuk UX/UI Bersuasana Terapeutik:** Konsep moden, menenangkan, bersih (*warm minimalist*, tona warna *sage green, muted teal, warm off-white*) yang memberi ketenangan dan keyakinan kepada pelawat yang sedang mengalami tekanan emosi.
3. **Automasi Pengurusan Klinik:** Mengautomasikan kalendar ketersediaan ahli psikologi, bayaran deposit tempahan, dan notifikasi peringatan sesi.
4. **Pematuhan Keselamatan & PDPA:** Memastikan data peribadi dan maklumat kesihatan mental klien dilindungi dengan penyulitan selamat.

---

## 3. Senarai Ciri-Ciri Baharu yang Perlu Disediakan (Key Features)

### A. Untuk Pelawat & Klien (Client-Facing Features)

1. **Sistem Tempahan Temu Janji Interaktif (Online Booking Engine):**
   * **Pilihan Mod Sesi:** Sesi Bersemuka di Cyberjaya (In-Person) atau Sesi Terapi Dalam Talian (Tele-Therapy).
   * **Pemilihan Kategori & Khidmat:** Penilaian Diagnostik (ADHD/ASD), Terapi Individu, Terapi Pasangan/Perkahwinan, Terapi Kanak-Kanak (Speech/OT/ABA).
   * **Pemilihan Pakar (Practitioner Profile & Availability):** Pelawat boleh melihat kepakaran, bio, serta memilih slot masa lapang terus daripada kalendar pengamal.
   * **Borang Pra-Pendaftaran Ringkas (Intake Form):** Maklumat asas klien, sebab rujukan, dan pengesahan borang persetujuan (*Informed Consent*).

2. **Gerbang Pembayaran Deposit Automatik (Payment Gateway):**
   * Bayaran deposit/penuh melalui FPX (Online Banking), DuitNow QR, atau Kad Kredit/Debit (cth: Chip / ToyyibPay / Billplz / Stripe).
   * Resit dan tiket tempahan dijana secara automatik.

3. **Ujian Saringan Kendiri Percuma (Interactive Mental Health Screeners):**
   * Ujian interaktif seperti **DASS-21** (Depression, Anxiety, Stress Scale) atau Saringan Awal Tumpuan Kanak-kanak.
   * Keputusan saringan dipaparkan serta-merta berserta cadangan perkhidmatan yang bersesuaian dan butang pantas *"Tempah Sesi Dengan Pakar Kami"*.

4. **Direktori Pasukan Pakar (Therapist & Counselor Profiles):**
   * Kad profil lengkap: Pengkhususan kepakaran, nombor pendaftaran badan berwibawa (cth: Lembaga Kaunselor Malaysia / MAHPC), bahasa komunikasi (Bahasa Melayu, English, dsb.), dan butang terus *"Tempah Sesi"*.

5. **Hab Edukasi & Sumber Kesihatan Mental (Psychoeducation & Resource Hub):**
   * Blog dan artikel berpandukan kategori isu (Cth: Hubungan Suami Isteri, Keibubapaan & Anak Istimewa, Trauma, Kerjaya & Burnout).
   * Halaman muat turun sumber percuma (e-Book panduan pengurusan stres, lembaran kerja regulasi emosi).

6. **Notis Bantuan Kecemasan (Crisis Helpline Banner):**
   * Sepanduk jelas di bahagian atas/bawah laman untuk makluman talian kecemasan krisis (seperti Talian HEAL 15555 atau Befrienders) sekiranya pelawat memerlukan intervensi segera.

---

### B. Untuk Pihak Pengurusan & Pakar (Clinic Admin & Practitioner Portal)

1. **Papan Pemuka Kalendar Berpusat (Centralised Booking Calendar):**
   * Pengurusan jadual masa kerja setiap pakar (waktu mula/tamat, waktu rehat, cuti tahunan).
   * Pencegahan *double-booking* serta sinkronisasi kalendar (Google Calendar / Apple Calendar).

2. **Sistem Peringatan Automatik (Automated WhatsApp & Email Reminders):**
   * Penghantaran notifikasi peringatan automatik 24 jam dan 2 jam sebelum waktu sesi kepada klien bagi meminimumkan kadar *no-show*.

3. **Pengurusan Rekod Klien Ringkas (Lightweight Clinic EMR):**
   * Profil data klien yang tersusun: Sejarah tempahan, status bayaran, catatan nota sesi (hanya boleh diakses oleh pakar bertugas mengikut tahap keselamatan privasi).

4. **Modul Pertanyaan Korporat (EAP / Wellness Workshops):**
   * Borang khas bagi syarikat swasta dan agensi kerajaan meminta sebut harga untuk saringan mental pekerja (*Employee Assistance Programme*) atau bengkel latihan pengurusan stres.

---

## 4. Cadangan Seni Bina Teknologi (Recommended Architecture)

Bagi menggantikan WordPress yang berat dan mudah terdedah kepada isu keselamatan serta konflik plugin:
* **Backend:** **Laravel** (Sangat mantap untuk logik tempahan temu janji tersuai, keselamatan data pesakit, pengurusan peranan pengguna *role & permission*, dan penyepaduan API).
* **Frontend:** **Tailwind CSS + Blade / Inertia.js (Vue atau React)** (Memastikan laman web dimuatkan dengan pantas, anggun di paparan telefon pintar, dan mesra SEO).
* **Pangkalan Data:** **MySQL / PostgreSQL** untuk pengurusan data transaksi dan rekod tempahan.
* **Integrasi Pihak Ketiga:**
  * Pembayaran: FPX / DuitNow QR (ToyyibPay, Billplz, atau Chip).
  * Notifikasi: WhatsApp Business API (Waha / Twilio) & Mel (Resend / Mailgun).
  * Tele-Terapi: Google Meet API atau Zoom API untuk penjanaan pautan panggilan video automatik.

---

## 5. Pelan Garis Masa Pelaksanaan (Implementation Timeline)

| Fasa | Aktiviti Utama | Anggaran Masa |
| :--- | :--- | :--- |
| **Fasa 1: UX/UI Design & Sitemap** | Penstrukturan sitemap kemas, wireframe UI, penentuan skema warna dan identiti visual (*calming aesthetic*). | 2 Minggu |
| **Fasa 2: Pembangunan Halaman Utama & Info** | Laman Utama, Profil Pasukan Pakar, Direktori Perkhidmatan, Hab Artikel & Asas SEO. | 2 Minggu |
| **Fasa 3: Sistem Tempahan & Pembayaran** | Enjin kalendar slot temu janji, integrasi borang intake, gerbang pembayaran FPX, integrasi WhatsApp reminder. | 3 Minggu |
| **Fasa 4: Portal Admin & Ujian (UAT)** | Dashboard staf kaunter, kawalan akses pakar, ujian keselamatan data pesakit & UAT menyeluruh. | 1-2 Minggu |
| **Fasa 5: Pelancaran & Pengalihan Trafik** | Konfigurasi domain sakeenahmedicare.net, 301 Redirect untuk SEO sedia ada, dan sesi latihan penggunaan kepada staf klinik. | 1 Minggu |

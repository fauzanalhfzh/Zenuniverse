<p align="center">
  <a href="https://lemmes.zenstory.id" target="_blank">
    <img src="https://github.com/user-attachments/assets/2d113284-5ca9-4c33-9958-39cb214c3152" width="400" alt="Zenuniverse Logo">
  </a>
</p>

# Zenuniverse

**Zenuniverse** adalah sebuah platform web pembelajaran interaktif yang dirancang untuk membantu pemula memahami konsep dasar pemrograman, logika, dan matematika melalui pengalaman belajar yang gamified (berbasis permainan). Platform ini dibangun menggunakan framework **Laravel**, **Livewire**, dan **Filament PHP**.

---

## 🌟 Fitur Utama

Zenuniverse menyajikan pengalaman belajar yang tidak membosankan berkat perpaduan konten edukasi dan interaktivitas.

1. **Manajemen Kursus & Pelajaran (Courses & Lessons)**
   Materi pembelajaran disusun secara hierarkis (Kursus > Pelajaran > Slide Konsep). Pengguna dapat mempelajari berbagai topik menarik seperti HTML Dasar, Logika Pemrograman, dan Matematika Dasar.

2. **Mini-Games Pembelajaran Interaktif**
   Sistem di Zenuniverse tidak hanya menggunakan teks, melainkan slide interaktif berupa:
   - **Trivia & Quiz:** Pertanyaan pilihan ganda untuk menguji pemahaman konsep.
   - **Code Arrange (Puzzle Kode):** Menyusun blok kode atau algoritma secara berurutan.
   - **Code Fill in the Blank:** Melengkapi bagian kode atau logika yang kosong.
   - **Block Code (Logika Visual):** Menarik dan meletakkan instruksi aksi/logika (drag-and-drop) untuk mencapai tujuan tertentu (misalnya, menggerakkan robot).

3. **Sistem Gamifikasi (XP, Level, & Badge)**
   - **Experience Points (XP):** Pengguna mendapatkan XP setiap kali menyelesaikan pelajaran atau menjawab kuis dengan benar.
   - **Sistem Level:** Akumulasi XP akan meningkatkan level pengguna (misal: Pemula, Menengah, Mahir).
   - **Badge (Lencana Prestasi):** Pengguna dapat memperoleh pencapaian khusus/badge ketika menyelesaikan suatu course atau mencapai target tertentu.

4. **Komunitas / Forum Diskusi (Post System)**
   Terdapat fitur komunitas yang memungkinkan antar pengguna saling berbagi pengetahuan, bertanya, dan berdiskusi seputar materi pembelajaran.

5. **Admin Panel yang Kuat (Filament)**
   Admin memiliki kontrol penuh untuk mengatur seluruh konten pembelajaran (Kursus, Pelajaran, Slide interaktif), manajemen pengguna, serta melihat statistik melalui panel Filament.

---

## 🛠 Teknologi yang Digunakan

Proyek ini dibangun di atas tumpukan teknologi (tech stack) berikut:

- **Framework Utama:** [Laravel 12.x](https://laravel.com/) (PHP)
- **Komponen Interaktif:** [Livewire 3](https://livewire.laravel.com/) & Alpine.js
- **Admin Panel:** [Filament v3](https://filamentphp.com/)
- **Styling:** Tailwind CSS
- **Database:** MySQL / SQLite

---

## 🚀 Panduan Instalasi (Development)

Jika Anda ingin menjalankan proyek **Zenuniverse** secara lokal, ikuti langkah-langkah berikut:

**1. Kloning Repositori**
```bash
git clone https://github.com/username/Zenuniverse.git
cd Zenuniverse
```

**2. Instalasi Dependensi PHP (Composer)**
```bash
composer install
```

**3. Konfigurasi Environment**
Salin file `.env.example` menjadi `.env` dan atur konfigurasi database Anda.
```bash
cp .env.example .env
```
Jangan lupa untuk membuat *Application Key*:
```bash
php artisan key:generate
```

**4. Instalasi Dependensi Frontend (NPM)**
```bash
npm install
npm run build
```

**5. Migrasi dan Seeder Database**
Proyek ini dilengkapi dengan seeder lengkap untuk inisialisasi Course, Lesson, minigames interaktif, Badge, Level, serta akun Admin.
```bash
php artisan migrate:fresh --seed
```
*Catatan: Akun default admin biasanya dapat menggunakan email `admin@zenuniverse.id` dengan password `password`.*

**6. Jalankan Server Lokal**
```bash
php artisan serve
```
Dan jalankan Vite dev server di terminal yang berbeda (untuk hot-reload aset):
```bash
npm run dev
```

Anda kini dapat mengakses aplikasi di `http://localhost:8000`.

---

## 📜 Lisensi

Proyek ini merupakan perangkat lunak *open-source* yang dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

*(Dokumentasi dan framework dasar berjalan dengan dukungan Laravel Framework)*

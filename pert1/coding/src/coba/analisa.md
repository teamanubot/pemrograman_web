# Analisis 5W + 1H dan SWOT Pertemuan 1

## 1. Analisis 5W + 1H

### **1. What (Apa yang digunakan dalam proyek ini?)**

Proyek ini menggunakan beberapa teknologi utama:

* **HTML, CSS, JavaScript** → Untuk membangun tampilan dan interaktivitas web.
* **Docker & Docker Compose** → Untuk mengelola container aplikasi agar berjalan di lingkungan yang terisolasi.
* **Nginx** → Berfungsi sebagai web server yang menangani permintaan HTTP dan mendistribusikan lalu lintas.
* **Konfigurasi `.env`** → Digunakan untuk menyimpan variabel lingkungan seperti database atau API keys.

File utama yang digunakan dalam proyek ini meliputi:

* `index.html` dan `div.html` → Struktur halaman utama.
* `style.css` → Pengaturan tampilan antarmuka.
* `main.js` → Berisi logika frontend aplikasi.
* `nginx.conf` → Konfigurasi server Nginx.
* `docker-compose.yml` → Skrip untuk menjalankan layanan dalam container Docker.

### **2. Why (Mengapa proyek ini dikembangkan dengan teknologi tersebut?)**

* **Docker digunakan** karena memungkinkan aplikasi berjalan secara konsisten di berbagai lingkungan tanpa masalah dependensi.
* **Nginx digunakan** untuk meningkatkan performa dan keamanan dalam menangani lalu lintas HTTP.
* **HTML, CSS, dan JavaScript digunakan** karena merupakan teknologi dasar dalam pengembangan web yang mudah digunakan dan dikembangkan.
* **Struktur berbasis container** mempermudah deployment ke berbagai platform, termasuk server cloud.

### **3. Who (Siapa yang terlibat dan siapa penggunanya?)**

* **Pengembang:** Proyek ini kemungkinan dibuat oleh seorang developer atau tim pengembang web yang memahami  **Docker, Nginx, serta pengembangan frontend** .
* **Pengguna akhir:** Orang yang mengakses aplikasi ini melalui browser web. Bisa jadi pengguna biasa atau tim internal suatu organisasi yang memerlukan aplikasi berbasis web.

### **4. Where (Di mana proyek ini dijalankan atau digunakan?)**

* **Di lingkungan lokal** → Pengembang dapat menjalankan proyek ini menggunakan Docker di komputer mereka.
* **Di server produksi** → Dengan konfigurasi yang ada, proyek ini dapat di-deploy ke **server cloud** seperti AWS, DigitalOcean, atau server VPS lainnya.
* **Di dalam container Docker** → Aplikasi ini dirancang untuk berjalan di dalam container untuk memudahkan deployment dan scaling.

### **5. When (Kapan proyek ini digunakan atau diimplementasikan?)**

* **Saat pengembangan** → Developer dapat menjalankan proyek ini untuk pengujian dan debugging sebelum dipublikasikan.
* **Saat deployment** → Proyek ini dapat langsung di-deploy ke server dan digunakan oleh pengguna kapan saja.
* **Saat membutuhkan aplikasi web statis atau dinamis** → Jika backend ditambahkan, proyek ini dapat dikembangkan lebih lanjut menjadi aplikasi web penuh.

### **6. How (Bagaimana cara kerja dan penggunaannya?)**

* **Menjalankan proyek:**
  1. Pastikan Docker dan Docker Compose telah diinstal.
  2. Jalankan perintah `docker-compose up -d` untuk menjalankan container.
  3. Akses aplikasi melalui browser dengan alamat yang telah dikonfigurasi.
* **Cara kerjanya:**
  * **Nginx menerima permintaan HTTP** dan meneruskannya ke layanan yang sesuai.
  * **Frontend (HTML, CSS, JS) ditampilkan di browser** untuk interaksi pengguna.
  * **Jika ada backend (belum ditemukan di proyek ini), maka backend akan menangani logika bisnis dan database.**

## 2. Analisis SWOT

### **Strengths (Kelebihan)** ✅

* **Arsitektur berbasis container** → Proyek ini dapat berjalan di berbagai platform tanpa masalah kompatibilitas.
* **Skalabilitas tinggi** → Dengan menggunakan Docker dan Nginx, aplikasi ini dapat dengan mudah diskalakan jika diperlukan.
* **Keamanan lebih baik** → Penggunaan Nginx memungkinkan pengelolaan lalu lintas HTTP yang lebih aman.
* **Struktur kode yang rapi** → Folder dan file dikategorikan dengan baik, memudahkan pengembangan dan pemeliharaan.

### **Weaknesses (Kelemahan)** ❌

* **Tidak ada backend** → Jika aplikasi ini memerlukan data dinamis, perlu backend tambahan seperti Node.js atau PHP.
* **Ketergantungan pada Docker** → Pengguna yang tidak familiar dengan Docker mungkin kesulitan dalam setup awal.

### **Opportunities (Peluang)** 🚀

* **Dapat dengan mudah di-deploy ke cloud** → Struktur berbasis container memungkinkan proyek ini berjalan di berbagai penyedia cloud.
* **Bisa dikembangkan lebih lanjut** → Jika backend ditambahkan, proyek ini bisa menjadi aplikasi berbasis database yang lebih kompleks.

### **Threats (Ancaman)** ⚠️

* **Keamanan konfigurasi** → Jika `nginx.conf` tidak dikonfigurasi dengan benar, bisa menjadi celah keamanan.
* **Kompatibilitas antar versi** → Jika ada perubahan pada versi Docker atau Nginx, bisa mempengaruhi kinerja proyek.


# Analisis Tag HTML dengan 5W + 1H dan SWOT

## 1. `<span><!DOCTYPE html></span>`

### 5W + 1H:

* **What**: Deklarasi tipe dokumen HTML.
* **Why**: Menentukan versi HTML yang digunakan agar browser dapat merender halaman dengan benar.
* **Who**: Digunakan oleh developer web.
* **Where**: Ditempatkan di awal dokumen HTML.
* **When**: Dibutuhkan saat membuat dokumen HTML.
* **How**: Ditulis di baris pertama dengan `<span><!DOCTYPE html></span>`.

### SWOT:

* **Strengths**: Memastikan kompatibilitas dengan standar HTML.
* **Weaknesses**: Tanpa deklarasi ini, beberapa browser dapat masuk ke "quirks mode".
* **Opportunities**: Memungkinkan pengembangan web lebih standar.
* **Threats**: Kesalahan dalam menuliskan deklarasi dapat menyebabkan masalah kompatibilitas.

---

## 2. `<span><html lang="en"></span>`

### 5W + 1H:

* **What**: Tag utama yang membungkus seluruh dokumen HTML.
* **Why**: Memberi tahu browser bahwa ini adalah dokumen HTML.
* **Who**: Digunakan oleh semua halaman web.
* **Where**: Setelah deklarasi `<span><!DOCTYPE html></span>`.
* **When**: Selalu ada dalam dokumen HTML.
* **How**: Ditulis sebagai `<span><html lang="en"></span>`.

### SWOT:

* **Strengths**: Memberi struktur dasar pada dokumen HTML.
* **Weaknesses**: Tanpa elemen ini, browser tidak dapat mengenali halaman sebagai HTML.
* **Opportunities**: Dapat menambahkan atribut `<span>lang</span>` untuk SEO dan aksesibilitas.
* **Threats**: Kesalahan dalam atribut bahasa dapat mempengaruhi SEO dan pengalaman pengguna.

---

## 3. `<span><head></span>`

### 5W + 1H:

* **What**: Bagian yang berisi metadata dan referensi eksternal seperti CSS.
* **Why**: Memberikan informasi kepada browser tentang halaman.
* **Who**: Digunakan oleh mesin pencari dan browser.
* **Where**: Sebelum `<span><body></span>` dalam struktur HTML.
* **When**: Dibutuhkan dalam setiap halaman HTML.
* **How**: Ditulis sebagai `<span><head></span>` dan berisi elemen seperti `<span><title></span>`, `<span><meta></span>`, dan `<span><link></span>`.

### SWOT:

* **Strengths**: Menyediakan metadata penting.
* **Weaknesses**: Kesalahan dalam penulisan dapat menyebabkan masalah rendering.
* **Opportunities**: Bisa ditambahkan elemen SEO dan favicon.
* **Threats**: Metadata yang buruk dapat mempengaruhi visibilitas di mesin pencari.

---

## 4. `<span><body></span>`

### 5W + 1H:

* **What**: Bagian utama yang berisi konten halaman.
* **Why**: Menampilkan elemen yang dapat dilihat oleh pengguna.
* **Who**: Digunakan oleh pengguna yang mengakses halaman web.
* **Where**: Setelah tag `<span><head></span>` dalam dokumen HTML.
* **When**: Diperlukan dalam setiap halaman HTML.
* **How**: Ditulis sebagai `<span><body></span>` dan berisi elemen-elemen UI.

### SWOT:

* **Strengths**: Menampilkan konten utama.
* **Weaknesses**: Tanpa `<span><body></span>`, halaman tidak dapat menampilkan informasi.
* **Opportunities**: Bisa dikembangkan dengan JavaScript dan CSS.
* **Threats**: Struktur HTML yang buruk dapat menyebabkan tampilan yang tidak sesuai.

---

## 5. `<span><h1></span>` - `<span><h6></span>`

### 5W + 1H:

* **What**: Tag heading untuk judul dan subjudul.
* **Why**: Untuk memberi struktur dan hierarki pada konten.
* **Who**: Digunakan oleh pengembang dan pembaca.
* **Where**: Di dalam `<span><body></span>`.
* **When**: Digunakan untuk memberikan informasi terstruktur.
* **How**: Ditulis sebagai `<span><h1>Judul</h1></span>` hingga `<span><h6></span>`.

### SWOT:

* **Strengths**: Meningkatkan keterbacaan dan SEO.
* **Weaknesses**: Terlalu banyak heading dapat membingungkan pengguna.
* **Opportunities**: Dapat digunakan untuk optimasi SEO.
* **Threats**: Salah penggunaan heading bisa merusak struktur dokumen.

---

## 6. `<span><p></span>`

### 5W + 1H:

* **What**: Tag paragraf untuk teks.
* **Why**: Untuk menyusun teks menjadi paragraf.
* **Who**: Digunakan oleh pengembang dan pembaca.
* **Where**: Di dalam `<span><body></span>`.
* **When**: Digunakan saat menampilkan teks.
* **How**: Ditulis sebagai `<span><p>Isi teks</p></span>`.

### SWOT:

* **Strengths**: Mempermudah format teks.
* **Weaknesses**: Tanpa `<span><p></span>`, teks bisa sulit dibaca.
* **Opportunities**: Bisa dikombinasikan dengan CSS.
* **Threats**: Format yang buruk dapat mengganggu pengalaman pengguna.

---

## 7. `<span><img></span>`

### 5W + 1H:

* **What**: Menampilkan gambar.
* **Why**: Untuk memperkaya tampilan.
* **Who**: Digunakan oleh semua pengguna web.
* **Where**: Di dalam `<span><body></span>`.
* **When**: Ketika ingin menampilkan gambar.
* **How**: Ditulis sebagai `<span><img src="path" alt="desc"></span>`.

### SWOT:

* **Strengths**: Menambah daya tarik visual.
* **Weaknesses**: Bisa memperlambat loading.
* **Opportunities**: Bisa dioptimalkan untuk SEO.
* **Threats**: Gambar besar dapat memperlambat situs.

---

## 8. `<span><form></span>`

### 5W + 1H:

* **What**: Formulir input data.
* **Why**: Untuk mengumpulkan informasi dari pengguna.
* **Who**: Digunakan oleh pengguna yang ingin mengirim data.
* **Where**: Di dalam `<span><body></span>`.
* **When**: Ketika ingin menerima input dari pengguna.
* **How**: Ditulis sebagai `<span><form>...</form></span>`.

### SWOT:

* **Strengths**: Interaksi langsung dengan pengguna.
* **Weaknesses**: Form yang tidak aman rentan terhadap serangan.
* **Opportunities**: Bisa dikombinasikan dengan validasi JavaScript.
* **Threats**: Form yang tidak terlindungi bisa menyebabkan kebocoran data.

---

## 9. `<span><script></span>`

### 5W + 1H:

* **What**: Menjalankan kode JavaScript.
* **Why**: Untuk meningkatkan interaktivitas.
* **Who**: Digunakan oleh developer dan pengguna.
* **Where**: Di `<span><head></span>` atau sebelum `<span></body></span>`.
* **When**: Ketika ingin menambahkan fungsionalitas dinamis.
* **How**: Ditulis sebagai `<span><script>...</script></span>`.

### SWOT:

* **Strengths**: Meningkatkan fungsionalitas.
* **Weaknesses**: Bisa memperlambat loading.
* **Opportunities**: Bisa membuat aplikasi web lebih interaktif.
* **Threats**: Script yang tidak aman bisa menyebabkan serangan XSS.

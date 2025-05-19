# Perkenalan

Nama            : Rivai  
NIM             : 2030801290  
Fakultas        : Ilmu Komputer  
Jurusan         : Teknik Informatika  
Mata Kuliah     : Pemrograman Website  
Pengajar        : JEFRY SUNUPURWA ASRI, S.Kom., M.Kom.  

**Tema Studi Kasus: Data Pembayaran**

---

Untuk informasi lebih lanjut, silakan lihat file [link analisis](https://github.com/teamanubot/pemrograman_web/tree/main/uts/analisis).

## Penjelasan Untuk file analisis Studi Kasus yang saya buat

### 1. Sistem Pengelolaan Pembayaran Manual

* Sistem TeamAnuBot menerapkan model verifikasi **manual** oleh admin terhadap data pembayaran yang dikirimkan pelanggan.
* Tidak menggunakan integrasi API pembayaran seperti Midtrans, Xendit, ataupun QRIS API, melainkan pelanggan mengunggah **bukti transfer** langsung ke sistem.
* Admin kemudian mengklasifikasikan dan menyetujui pembayaran melalui panel verifikasi di dashboard Filament.

**Kaitan dengan tema**: Proses ini menekankan bagaimana data pembayaran ditangani secara internal dengan kontrol penuh untuk menjaga keabsahan transaksi.

### 2. Formulir Input dan Penyimpanan Bukti Pembayaran

* Pengguna cukup sekali mengisi formulir dengan **nama, nomor WhatsApp, jenis langganan, dan bukti pembayaran (gambar)**.
* File bukti pembayaran disimpan secara aman di **storage internal Laravel**, tanpa penyimpanan cloud eksternal.
* Ukuran file maksimal dibatasi dan divalidasi untuk menjaga integritas data.

**Kaitan dengan tema**: Poin ini menunjukkan bagaimana sistem menangani input data pembayaran secara terstruktur dan terdokumentasi.

### 3. Proses Verifikasi dan Approval Pembayaran

* Verifikasi hanya dapat dilakukan oleh **admin**, termasuk klasifikasi layanan ke kategori *selfbot* atau *official bot*.
* Setelah status pembayaran berubah menjadi **approved**, maka data pelanggan akan dimasukkan ke tabel `data_penyewa_bot`, lengkap dengan masa aktif dan jenis langganannya.
* Sistem menggunakan model RBAC (Role-Based Access Control) agar hanya pihak berwenang yang dapat mengakses dan memproses pembayaran.

**Kaitan dengan tema**: Menunjukkan pentingnya alur verifikasi yang valid dan akurat dalam pengelolaan data pembayaran.

### 4. Akses User Terhadap Status Pembayaran

* Pelanggan hanya dapat melihat **status pembayaran**, tanpa bisa mengubah atau menghapus data yang sudah dikirim.
* Jika pembayaran telah disetujui, pelanggan juga dapat melihat **jenis langganan, tanggal mulai, dan tanggal berakhir**.

**Kaitan dengan tema**: Memberikan transparansi terhadap data pembayaran kepada pelanggan dengan batasan akses yang aman.

### 5. Desain Basis Data Pembayaran

* Tabel `statuses` mencatat data awal seperti nama pelanggan, nomor WhatsApp, jenis langganan, status pembayaran, dan path bukti pembayaran.
* Tabel `data_penyewa_bot` menyimpan hasil klasifikasi final setelah pembayaran disetujui, termasuk informasi durasi langganan.

**Kaitan dengan tema**: Struktur basis data ini menunjukkan bagaimana data pembayaran dicatat dan ditelusuri secara sistematis.

### 6. Tidak Bergantung pada Sistem Pembayaran Eksternal

* Dengan tidak menggunakan API eksternal, sistem ini mengandalkan proses internal yang **fleksibel namun terkendali**, cocok untuk bisnis skala kecil hingga komunitas.
* Metode pembayaran bisa melalui transfer bank, e-wallet, atau QRIS secara manual.

**Kaitan dengan tema**: Menunjukkan bagaimana data pembayaran tetap dapat dikelola dengan baik tanpa tergantung pada sistem pihak ketiga.

### Kesimpulan

Studi kasus pada dokumen BRD TeamAnuBot menekankan bagaimana sistem menangani **pengumpulan, penyimpanan, verifikasi, dan pemantauan data pembayaran pelanggan** secara efektif. Pendekatan manual namun terstruktur, dengan kontrol admin penuh dan transparansi akses bagi pengguna, membuktikan bahwa pengelolaan data pembayaran dapat dilakukan secara efisien tanpa integrasi kompleks. Hal ini sepenuhnya relevan dan sesuai dengan **tema “Data Pembayaran”**.

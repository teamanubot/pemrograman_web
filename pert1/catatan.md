# Pengertian HTML

HTML (HyperText Markup Language) adalah bahasa standar yang digunakan untuk membuat dan menyusun halaman web. HTML digunakan untuk mendeskripsikan struktur dari halaman web dengan menggunakan elemen-elemen yang didefinisikan oleh tag. Setiap elemen HTML memiliki tag pembuka dan tag penutup, serta atribut yang memberikan informasi tambahan tentang elemen tersebut.

HTML memungkinkan pengembang web untuk menambahkan teks, gambar, tautan, tabel, dan berbagai elemen lainnya ke dalam halaman web. HTML juga mendukung integrasi dengan CSS (Cascading Style Sheets) dan JavaScript untuk memperkaya tampilan dan interaktivitas halaman web.

## Ilmu yang Didapat pada Pertemuan 1

### 1. Cara Membuat dan Mengkonfigurasi `nginx.conf`
`nginx.conf` adalah file konfigurasi utama untuk Nginx yang mengatur cara server web melayani permintaan. Berikut adalah contoh konfigurasi yang digunakan:

```nginx
server {
    listen 80;
    server_name localhost;

    root /usr/share/nginx/html;
    index index.html index.htm;

    location / {
        try_files $uri $uri/ =404;
    }

    location /latihan {
        alias /usr/share/nginx/html/latihan;
        index index.html index.htm home.html;
        try_files $uri $uri.html $uri/ =404;
    }
}
```

**Penjelasan:**
- `listen 80;` → Nginx akan mendengarkan permintaan HTTP pada port 80.
- `server_name localhost;` → Server ini akan melayani permintaan dari localhost.
- `root /usr/share/nginx/html;` → Direktori root tempat file HTML berada.
- `index index.html index.htm;` → Menentukan file yang digunakan sebagai halaman utama.
- `location /` → Menangani semua permintaan utama.
  - `try_files $uri $uri/ =404;` → Jika file tidak ditemukan, akan menampilkan error 404.
- `location /latihan` → Menangani request ke `/latihan` dengan alias ke direktori `/usr/share/nginx/html/latihan`.

### 2. Cara Membuat dan Mengkonfigurasi `.env`
File `.env` digunakan untuk menyimpan variabel lingkungan yang dapat digunakan dalam konfigurasi aplikasi. Berikut adalah contoh `.env` yang digunakan:

```env
COMPOSE_PROJECT_NAME=esgul
REPOSITORY_NAME=pemweb
IMAGE_TAG=latest
```

**Penjelasan:**
- `COMPOSE_PROJECT_NAME=esgul` → Menentukan nama proyek Docker Compose.
- `REPOSITORY_NAME=pemweb` → Menentukan nama repository yang digunakan.
- `IMAGE_TAG=latest` → Menggunakan versi terbaru dari image Docker.

### 3. Cara Membuat dan Mengkonfigurasi `docker-compose.yml`
File `docker-compose.yml` digunakan untuk mendefinisikan layanan yang akan dijalankan dalam Docker. Berikut adalah konfigurasi yang digunakan:

```yaml
services:
  web:
    container_name: nginx_esgul
    image: nginx:latest
    ports:
      - 80:80
    volumes:
      - ./nginx/nginx.conf:/etc/nginx/conf.d/default.conf
      - ./src:/usr/share/nginx/html
      - ./latihan:/usr/share/nginx/html/latihan
```

**Penjelasan:**
- `services:` → Menentukan layanan yang akan dijalankan.
- `web:` → Nama layanan untuk server web.
- `container_name: nginx_esgul` → Menentukan nama container.
- `image: nginx:latest` → Menggunakan image Nginx versi terbaru.
- `ports:` → Memetakan port container ke port host (80:80).
- `volumes:` → Menyediakan direktori dari host ke dalam container:
  - `./nginx/nginx.conf:/etc/nginx/conf.d/default.conf` → Menggunakan konfigurasi Nginx yang dibuat.
  - `./src:/usr/share/nginx/html` → Menghubungkan direktori `src` sebagai direktori root.
  - `./latihan:/usr/share/nginx/html/latihan` → Menghubungkan direktori latihan.

### 4. Cara Membuat dan Menghapus Kontainer
Untuk menjalankan atau menghapus container dengan Docker Compose, berikut perintah yang digunakan:

- **Menjalankan container:**
  ```sh
  docker-compose up -d --build
  ```
  Perintah ini akan menjalankan container dalam mode `detached` (-d) dan membangun ulang jika ada perubahan konfigurasi.

- **Menghentikan dan menghapus container:**
  ```sh
  docker-compose down
  ```
  Perintah ini akan menghentikan dan menghapus semua container serta jaringan yang dibuat oleh Docker Compose.

### Kesimpulan
Pada pertemuan pertama ini, kita telah mempelajari dasar-dasar konfigurasi dan pengelolaan server web menggunakan Nginx serta bagaimana mengatur lingkungan pengembangan berbasis Docker Compose. Ilmu yang didapat meliputi:
- Konfigurasi `nginx.conf` untuk mengatur bagaimana server web melayani permintaan.
- Penggunaan `.env` untuk menyimpan variabel lingkungan.
- Konfigurasi `docker-compose.yml` untuk mengelola layanan dalam container.
- Perintah dasar Docker Compose untuk menjalankan dan menghapus container.

Dengan memahami konsep-konsep ini, kita dapat dengan mudah membangun dan mengelola lingkungan pengembangan berbasis Docker dan Nginx dengan lebih efisien.
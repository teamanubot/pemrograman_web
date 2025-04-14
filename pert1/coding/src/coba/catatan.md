# Pengertian HTML

HTML (HyperText Markup Language) adalah bahasa standar yang digunakan untuk membuat dan menyusun halaman web. HTML digunakan untuk mendeskripsikan struktur dari halaman web dengan menggunakan elemen-elemen yang didefinisikan oleh tag. Setiap elemen HTML memiliki tag pembuka dan tag penutup, serta atribut yang memberikan informasi tambahan tentang elemen tersebut.

HTML memungkinkan pengembang web untuk menambahkan teks, gambar, tautan, tabel, dan berbagai elemen lainnya ke dalam halaman web. HTML juga mendukung integrasi dengan CSS (Cascading Style Sheets) dan JavaScript untuk memperkaya tampilan dan interaktivitas halaman web.

- index.html
```html
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamu Nanyak Caranya???</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <img src="https://media.tenor.com/xebI04Po4-oAAAAj/manekineko-cat-meme.gif" class="custom-cursor" id="cursor">
    <canvas></canvas>
    <section>
        <h1>RIVAI GANTENG</h1>
        <img src="https://res.cloudinary.com/dk0z4ums3/image/upload/v1661753019/attached_image/inilah-cara-merawat-anak-kucing-yang-tepat-0-alodokter.jpg"
            alt="Anak Kucing">
    </section>
    <script src="main.js"></script>
</body>

</html>
```

Penjelasan tag:
1. `<!DOCTYPE html>`: Mendeklarasikan tipe dokumen dan versi HTML yang digunakan. Ini memastikan dokumen diparsing sebagai HTML5.
2. `<html lang="id">`: Elemen root dari dokumen HTML. Atribut `lang` menentukan bahasa dokumen (dalam hal ini Bahasa Indonesia).
3. `<head>`: Berisi informasi meta tentang dokumen, seperti judul dan tautan ke skrip dan stylesheet.
4. `<meta charset="UTF-8">`: Menentukan encoding karakter untuk dokumen, memastikan dapat menampilkan berbagai karakter.
5. `<meta name="viewport" content="width=device-width, initial-scale=1.0">`: Memastikan halaman web responsif dengan mengatur viewport agar sesuai dengan lebar perangkat.
6. `<title>Kamu Nanyak Caranya???</title>`: Menentukan judul dokumen, yang muncul di bilah judul atau tab browser.
7. `<link rel="stylesheet" href="style.css" />`: Menautkan file CSS eksternal untuk mendesain dokumen.
8. `<body>`: Berisi konten dari dokumen HTML yang terlihat oleh pengguna.
9. `<img src="https://media.tenor.com/xebI04Po4-oAAAAj/manekineko-cat-meme.gif" class="custom-cursor" id="cursor">`: Menyematkan gambar dalam dokumen dengan kelas `custom-cursor` dan id `cursor`.
10. `<canvas></canvas>`: Wadah untuk grafik, yang dapat digambar menggunakan JavaScript.
11. `<section>`: Mendefinisikan sebuah bagian dalam dokumen, digunakan untuk mengelompokkan konten terkait.
12. `<h1>RIVAI GANTENG</h1>`: Elemen heading, dengan `h1` sebagai tingkat tertinggi.
13. `<img src="..." alt="Anak Kucing">`: Menyematkan gambar dalam dokumen. Atribut `src` menentukan URL gambar, dan atribut `alt` memberikan teks alternatif.
14. `<script src="main.js"></script>`: Menautkan file JavaScript eksternal ke dokumen.

- div.html
```html
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        This is a div element.
        <p>This is a paragraph element inside a div element.</p>
    </div>
</body>

</html>
```

Penjelasan tag:
1. `<!DOCTYPE html>`: Mendeklarasikan tipe dokumen dan versi HTML yang digunakan. Ini memastikan dokumen diparsing sebagai HTML5.
2. `<html lang="en">`: Elemen root dari dokumen HTML. Atribut `lang` menentukan bahasa dokumen (dalam hal ini Bahasa Inggris).
3. `<head>`: Berisi informasi meta tentang dokumen, seperti judul dan tautan ke skrip dan stylesheet.
4. `<meta charset="UTF-8">`: Menentukan encoding karakter untuk dokumen, memastikan dapat menampilkan berbagai karakter.
5. `<meta name="viewport" content="width=device-width, initial-scale=1.0">`: Memastikan halaman web responsif dengan mengatur viewport agar sesuai dengan lebar perangkat.
6. `<title>Document</title>`: Menentukan judul dokumen, yang muncul di bilah judul atau tab browser.
7. `<body>`: Berisi konten dari dokumen HTML yang terlihat oleh pengguna.
8. `<div>`: Elemen kontainer generik yang digunakan untuk mengelompokkan elemen lain.
9. `<p>This is a paragraph element inside a div element.</p>`: Elemen paragraf yang berada di dalam elemen `div`.

# Pengertian CSS
CSS (Cascading Style Sheets) adalah bahasa yang digunakan untuk mendesain dan mengatur tampilan halaman web. CSS memungkinkan pengembang web untuk memisahkan konten HTML dari presentasi visualnya, sehingga memudahkan pengelolaan dan pemeliharaan kode. Dengan CSS, pengembang dapat mengatur tata letak, warna, font, dan berbagai aspek visual lainnya dari elemen-elemen HTML.

- style.css
```css
body {
    background-color: aquamarine;
    margin: 0;
    overflow: hidden;
    font-family: Arial, sans-serif;
    cursor: none;
}

.custom-cursor {
    position: absolute;
    width: 50px;
    height: 50px;
    pointer-events: none;
    z-index: 1000;
}

section {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

h1 {
    text-align: center;
    font-size: 3em;
    color: #ff00ff;
    text-shadow: 2px 2px 5px cyan, -2px -2px 5px yellow;
    animation: goyang 0.1s infinite alternate;
}

@keyframes goyang {
    0% {
        transform: rotate(-2deg) scale(1);
    }

    100% {
        transform: rotate(2deg) scale(1.05);
    }
}

img {
    width: 50%;
    height: auto;
    border-radius: 10px;
}

canvas {
    position: absolute;
    top: 0;
    left: 0;
}
```

Penjelasan CSS:

1. body: Mengatur gaya dasar untuk elemen body.
    - background-color: aquamarine; → Mengatur warna latar belakang
    - margin: 0;: Menghilangkan margin default.
    - overflow: hidden;: Menyembunyikan konten yang meluap dari elemen body.
    - font-family: Arial, sans-serif;: Mengatur jenis huruf menjadi Arial atau sans-serif.
    - cursor: none;: Menyembunyikan kursor default.

2. .custom-cursor: Mengatur gaya untuk elemen dengan kelas custom-cursor.
    - position: absolute;: Mengatur posisi absolut relatif terhadap    elemen terdekat yang diposisikan.
    - width: 50px;: Mengatur lebar elemen menjadi 50 piksel.
    - height: 50px;: Mengatur tinggi elemen menjadi 50 piksel.
    - pointer-events: none;: Menonaktifkan interaksi pointer pada elemen ini.
    - z-index: 1000;: Mengatur z-index untuk memastikan elemen berada di atas elemen lain.

3. section: Mengatur gaya untuk elemen section.
    - display: flex;: Mengatur elemen sebagai flex container.
    - flex-direction: column;: Mengatur arah flex menjadi kolom.
    - align-items: center;: Mengatur item flex agar sejajar di tengah secara horizontal.
    - justify-content: center;: Mengatur item flex agar sejajar di tengah secara vertikal.
    - height: 100vh;: Mengatur tinggi elemen menjadi 100% dari tinggi viewport.

4. h1: Mengatur gaya untuk elemen heading h1.
    - text-align: center;: Mengatur teks agar rata tengah.
    - font-size: 3em;: Mengatur ukuran huruf menjadi 3 em.
    - color: #ff00ff;: Mengatur warna teks menjadi magenta.
    - text-shadow: 2px 2px 5px cyan, -2px -2px 5px yellow;: Mengatur bayangan teks dengan warna cyan dan kuning.
    - animation: goyang 0.1s infinite alternate;: Mengatur animasi dengan nama goyang selama 0.1 detik, berulang tanpa batas, dan bergantian.

5. @keyframes goyang: Mendefinisikan animasi goyang.
    - 0%: Mengatur transformasi pada awal animasi.
    - transform: rotate(-2deg) scale(1);: Memutar elemen -2 derajat dan mengatur skala menjadi 1.
    - 100%: Mengatur transformasi pada akhir animasi.
    - transform: rotate(2deg) scale(1.05);: Memutar elemen 2 derajat dan mengatur skala menjadi 1.05.
    
6. img: Mengatur gaya untuk elemen gambar img.
    - width: 50%;: Mengatur lebar gambar menjadi 50% dari elemen induknya.
    - height: auto;: Mengatur tinggi gambar secara otomatis agar sesuai dengan lebar.
    - border-radius: 10px;: Mengatur sudut gambar menjadi melengkung dengan radius 10 piksel.

7. canvas: Mengatur gaya untuk elemen canvas.
    - position: absolute;: Mengatur posisi absolut relatif terhadap elemen terdekat yang diposisikan.
    - top: 0;: Mengatur posisi atas elemen menjadi 0.
    - left: 0;: Mengatur posisi kiri elemen menjadi 0.

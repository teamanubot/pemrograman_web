<main>
    <section class="banner bg-tertiary position-relative overflow-hidden">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <!-- Kiri: Teks -->
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="block text-center text-lg-start pe-0 pe-xl-5">
                        <h1 class="text-capitalize mb-4">TeamAnuBot</h1>
                        <p class="mb-4 justify-content-center">
                            TeamAnuBot adalah sebuah sistem layanan pelanggan berbasis bot LINE yang berfokus pada
                            penyewaan dan pengelolaan selfbot maupun official bot LINE. Sistem ini dirancang untuk
                            mempermudah komunikasi otomatis antara pemilik bisnis dan pelanggannya melalui platform LINE
                            yang populer di Indonesia. <br><br> Kini, TeamAnuBot telah berevolusi menjadi solusi yang
                            lebih modern dan terintegrasi. Proses registrasi akun menggunakan verifikasi OTP melalui API
                            bot WhatsApp, sementara invoice pemesanan juga dikirim secara otomatis melalui channel
                            WhatsApp pelanggan. <br><br> Dalam hal pembayaran, TeamAnuBot kini mengandalkan integrasi
                            payment gateway Midtrans, memungkinkan pelanggan melakukan pembayaran secara langsung saat
                            pemesanan dengan metode pembayaran yang beragam dan aman. Proses verifikasi dilakukan secara
                            otomatis, meminimalkan intervensi manual dan mempercepat aktivasi layanan. <br><br> Untuk
                            fleksibilitas pengelolaan data, sistem ini juga dilengkapi dengan API internal yang
                            memungkinkan kontrol dan integrasi langsung dengan database layanan, memberikan kemudahan
                            bagi admin untuk melakukan monitoring, pengelolaan akun, dan manajemen data secara
                            real-time. <br><br> TeamAnuBot tetap mempertahankan fokus pada otomatisasi interaksi
                            pelanggan melalui bot LINE, baik selfbot maupun official bot, dengan pengawasan penuh oleh
                            admin dalam proses penting seperti pengaturan masa aktif dan manajemen akses. <br><br>
                            Platform ini dibangun dengan teknologi web modern seperti Laravel 12, Filament v3, dan
                            Docker, serta memanfaatkan LINE Messaging API sebagai antarmuka utama kepada pelanggan.
                            Antarmuka sistem menggunakan Blade, Bootstrap, dan Livewire untuk memberikan pengalaman
                            pengguna yang responsif dan konsisten di berbagai perangkat. <br><br> TeamAnuBot percaya
                            bahwa otomatisasi layanan pelanggan dapat berjalan seiring dengan fleksibilitas, keamanan,
                            dan transparansi. Dengan sistem yang efisien, mudah digunakan, dan dirancang untuk memenuhi
                            kebutuhan baik pengelola maupun pelanggan, TeamAnuBot siap menjadi mitra andalan bagi
                            individu dan komunitas yang menggunakan LINE dan WhatsApp sebagai saluran utama komunikasi
                            layanan mereka.
                        </p>
                        <section id="order" class="mb-4">
                            <a type="button" class="btn btn-primary" href="/order">
                                Berlangganan Sekarang Juga!
                                <span style="font-size: 14px;" class="ms-2 fas fa-arrow-right"></span>
                            </a>
                        </section>
                    </div>
                </div>

                <!-- Kanan: Gambar -->
                <div class="col-lg-6">
                    <div class="ps-lg-5 text-center">
                        <img loading="lazy" decoding="async" src="{{ asset('front/images/tab.jpeg') }}"
                            alt="banner image" class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

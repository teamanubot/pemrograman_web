<main>
    @section('nav')
        @include('components.partials.nav-product')
    @endsection
    <section class="section py-5">
        <div class="container">
            <h2 class="text-center mb-5">Subscription Type</h2>
            @if (!Auth::guard('akun')->check())
                <div class="alert alert-warning text-center">
                    Anda harus <a href="{{ route('akun.login') }}">login terlebih dahulu</a>
                    untuk mengakses form ini.
                </div>
            @else
                {{-- Popup --}}
                @if ($showPopup && $popupProduct)
                    <div class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center"
                        style="background: rgba(0, 0, 0, 0.6); z-index: 9999;">
                        <div class="bg-white rounded shadow p-4"
                            style="max-width: 500px; width: 100%; position: relative;">
                            <button class="btn-close position-absolute top-0 end-0 m-3"
                                wire:click="$set('showPopup', false)">
                            </button>

                            <h5 class="mb-3 text-success">Berhasil membeli produk!</h5>

                            {{-- Instruksi Pembayaran --}}
                            <p class="fw-bold">Silahkan lakukan pembayaran ke kode QR di bawah ini:</p>
                            <div class="text-center mb-3">
                                <img src="{{ asset('front/images/qr-code.jpg') }}" alt="QR Code" style="width: 200px;">
                            </div>

                            {{-- Informasi Produk --}}
                            <h5>{{ $popupProduct->name }}</h5>
                            <div class="text-muted" style="text-align: justify;">
                                {!! $popupProduct->description !!}
                            </div>

                            <p class="fw-bold text-primary mt-3">
                                Total Pembayaran: Rp {{ number_format($randomizedPrice, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @endif

                {{-- List Produk --}}
                <div class="row justify-content-center">
                    @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="rounded shadow py-5 px-4 text-center">
                                <h3 class="mb-2">{{ $product->name }}</h3>
                                <div class="text-muted">{!! $product->description !!}</div>
                                <p class="fw-bold text-primary">
                                    Harga: Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <p><strong>Stock tersedia selama Subscription masih ditampilkan</strong></p>
                                <button wire:click="order({{ $product->id }})" class="btn btn-sm btn-outline-primary">
                                    Order
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada produk sepatu tersedia.</p>
                        </div>
                    @endforelse
                </div>
            @endif
        </div>
    </section>
</main>

@extends('auth.app')

@section('nav')
    @include('components.partials.nav-product')
@endsection

@section('content')
    <section class="section py-5">
        <div class="container">
            <h2 class="text-center mb-5">Subscription Type</h2>

            @if (!Auth::guard('akun')->check())
                <div class="alert alert-warning text-center">
                    Anda harus <a href="{{ route('akun.login') }}">login terlebih dahulu</a>
                    untuk mengakses form ini.
                </div>
            @else
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
                                <button class="btn btn-sm btn-outline-primary" onclick="startPayment({{ $product->id }})">
                                    Order
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada produk tersedia.</p>
                        </div>
                    @endforelse
                </div>
            @endif
        </div>
    </section>

    {{-- Snap JS --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    {{-- Axios CDN (jika belum tersedia di layout) --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        function startPayment(productId) {
            const userName = '{{ Auth::guard('akun')->user()->name }}';
            const userEmail = '{{ Auth::guard('akun')->user()->email }}';
            const userPhone = '{{ Auth::guard('akun')->user()->whatsapp_number }}';

            fetch('{{ route('midtrans.token') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        name: userName,
                        email: userEmail,
                        phone: userPhone
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.token) {
                        snap.pay(data.token, {
                            onSuccess: function(result) {
                                axios.post('{{ route('midtrans.success') }}', {
                                        product_id: productId,
                                        midtrans_result: JSON.parse(JSON.stringify(
                                            result)) // <-- ini kuncinya
                                    })
                                    .then(res => {
                                        window.location.href =
                                        '{{ route('cek-status') }}'; // 🔁 Redirect ke halaman cek status
                                    })
                                    .catch(error => {
                                        console.error(error);
                                        alert("Gagal menyimpan data. Silakan hubungi admin.");
                                    });
                            },
                            onPending: function(result) {
                                alert('Transaksi belum selesai.');
                            },
                            onError: function(result) {
                                alert('Terjadi kesalahan saat memproses pembayaran.');
                            }
                        });
                    } else {
                        alert(data.error || 'Gagal mendapatkan token Midtrans');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('Gagal terhubung ke server.');
                });
        }
    </script>
@endsection

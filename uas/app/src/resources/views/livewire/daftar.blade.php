    <main>
        @section('head')
            @include('components.partials.head-daftar')
        @endsection

        @section('nav')
            @include('components.partials.nav-daftar')
        @endsection

        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h3 class="card-title mb-4 text-center">Form Pendaftaran TeamAnuBot</h3>

                                @if (!Auth::guard('akun')->check())
                                    <div class="alert alert-warning text-center">
                                        Anda harus <a href="{{ route('akun.login') }}">login terlebih dahulu</a>
                                        untuk mengakses form ini.
                                    </div>
                                @else
                                    {{-- Form Pendaftaran --}}
                                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Nama</label>
                                            <input type="text" id="name" wire:model.defer="name"
                                                class="form-control @error('name') is-invalid @enderror" required>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="whatsapp_number">Nomor WhatsApp</label>
                                            <input type="text" id="whatsapp_number" wire:model.defer="whatsapp_number"
                                                class="form-control @error('whatsapp_number') is-invalid @enderror" required
                                                placeholder="Contoh: 081234567890">
                                            @error('whatsapp_number')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="price">Nominal (Rp)</label>
                                            <input type="number" id="price" wire:model.defer="price"
                                                class="form-control @error('price') is-invalid @enderror" required
                                                placeholder="Contoh: 10000">
                                            @error('price')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="subscription_type">Jenis Langganan</label>
                                            <select id="subscription_type" wire:model.defer="subscription_type"
                                                class="form-select text-center pe-0 ps-0 py-1 @error('subscription_type') is-invalid @enderror"
                                                required>
                                                <option value="" disabled class="text-muted">-- Pilih --</option>
                                                <option value="selfbot">Selfbot</option>
                                                <option value="official bot">Official Bot</option>
                                            </select>
                                            @error('subscription_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label" for="payment_proof">Bukti Pembayaran</label>
                                            <input type="file" id="payment_proof" wire:model="payment_proof"
                                                accept="image/*,application/pdf"
                                                class="form-control @error('payment_proof') is-invalid @enderror" required>
                                            @error('payment_proof')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100">Kirim</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Popup Sukses --}}
        @if ($showPopup && is_array($popupData) && !empty($popupData))
            <div class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center"
                style="background: rgba(0, 0, 0, 0.6); z-index: 9999;">
                <div class="bg-white rounded shadow p-4" style="max-width: 500px; width: 100%; position: relative;">
                    <button class="btn-close position-absolute top-0 end-0 m-3"
                        wire:click="$set('showPopup', false)"></button>
                    <h4 class="text-success mb-2 text-center">Data berhasil dikirim dengan detail:</h4>

                    <ul class="list-unstyled mb-2">
                        <li><strong>ID:</strong> {{ $popupData['id'] }}</li>
                        <li><strong>Nama:</strong> {{ $popupData['name'] }}</li>
                        <li><strong>No WhatsApp:</strong> {{ $popupData['whatsapp_number'] }}</li>
                        <li><strong>Jenis Langganan:</strong> {{ $popupData['subscription_type'] }}</li>
                        <li><strong>Nominal:</strong> Rp{{ number_format($popupData['price'], 0, ',', '.') }}</li>
                        <li class="mt-2">
                            <strong>Bukti Pembayaran:</strong><br>
                            @php $ext = pathinfo($popupData['payment_proof'], PATHINFO_EXTENSION); @endphp

                            @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                <img src="{{ asset('storage/' . $popupData['payment_proof']) }}" alt="Bukti Pembayaran"
                                    class="img-fluid rounded mt-2"
                                    style="width: 100%; max-height: 600px; object-fit: contain;">
                            @else
                                <a href="{{ asset('storage/' . $popupData['payment_proof']) }}" target="_blank"
                                    class="btn btn-sm btn-outline-secondary mt-2">Lihat Bukti PDF</a>
                            @endif
                        </li>
                    </ul>

                    <p class="text-center text-muted">Silakan tunggu diverifikasi oleh Admin.</p>
                </div>
            </div>
        @endif
    </main>

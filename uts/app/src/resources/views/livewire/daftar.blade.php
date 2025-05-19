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

                            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Nama</label>
                                    <input type="text" id="name" wire:model.defer="name" class="form-control" required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="whatsapp_number">Nomor WhatsApp</label>
                                    <input type="text" id="whatsapp_number" wire:model.defer="whatsapp_number" class="form-control" required>
                                    @error('whatsapp_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="subscription_type">Jenis Langganan</label>
                                    <select id="subscription_type" wire:model.defer="subscription_type" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="selfbot">Selfbot</option>
                                        <option value="official bot">Official Bot</option>
                                    </select>
                                    @error('subscription_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="payment_proof">Bukti Pembayaran</label>
                                    <input type="file" id="payment_proof" wire:model="payment_proof" accept="image/*,application/pdf" class="form-control" required>
                                    @error('payment_proof')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Popup Sukses --}}
    @if ($showPopup && $popupData)
        <div class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center"
            style="background: rgba(0, 0, 0, 0.6); z-index: 9999;">
            <div class="bg-white rounded shadow p-4" style="max-width: 500px; width: 100%; position: relative;">
                <button class="btn-close position-absolute top-0 end-0 m-3"
                        wire:click="$set('showPopup', false)">
                </button>
                <h4 class="text-success mb-2 text-center">Data berhasil dikirim dengan detail:</h4>

                <ul class="list-unstyled mb-2">
                    <li><strong>ID:</strong> {{ $popupData['id'] }}</li>
                    <li><strong>Nama:</strong> {{ $popupData['name'] }}</li>
                    <li><strong>No WhatsApp:</strong> {{ $popupData['whatsapp_number'] }}</li>
                    <li><strong>Jenis Langganan:</strong> {{ $popupData['subscription_type'] }}</li>
                    <li class="mt-2">
                        <strong>Bukti Pembayaran:</strong><br>
                        @php
                            $ext = pathinfo($popupData['payment_proof'], PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                            <img src="{{ asset('storage/' . $popupData['payment_proof']) }}"
                                alt="Bukti Pembayaran"
                                class="img-fluid rounded mt-2 text-center"
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

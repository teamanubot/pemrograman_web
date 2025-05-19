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

                            @if (session()->has('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

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
</main>
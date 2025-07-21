<main>
    @section('head')
        @include('components.partials.head-status')
    @endsection

    @section('nav')
        @include('components.partials.nav-status')
    @endsection

    <div class="container py-5">
        <h1 class="mb-4">Cek Status Langganan TeamAnuBot</h1>

        {{-- Tampilkan pesan jika belum login --}}
        @if (!Auth::guard('akun')->check())
            <div class="alert alert-warning text-center">
                Anda harus <a href="{{ route('akun.login') }}">login terlebih dahulu</a>
                untuk mengakses halaman ini.
            </div>
        @else
            {{-- Tampilkan error jika ada --}}
            @if ($error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endif

            {{-- Hasil pencarian --}}
            @if ($error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endif

            @if (count($statuses) > 0)
                <hr>
                <h3>Daftar Status Langganan Anda:</h3>

                @foreach ($statuses as $status)
                    <div class="card my-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $status->nama }} (ID: {{ $status->id }})</h5>

                            <ul class="list-group mt-2 mb-3">
                                <li class="list-group-item">
                                    <strong>Status Pembayaran:</strong>
                                    @if ($status->payment_status === 'pending')
                                        <span class="badge-status badge-pending">Pending</span>
                                    @elseif ($status->payment_status === 'approved')
                                        <span class="badge-status badge-approved">Approved</span>
                                    @else
                                        <span class="badge-status badge-rejected">Rejected</span>
                                    @endif
                                </li>

                                @if ($status->payment_status === 'approved' && isset($subscriptionData[$status->id]))
                                    <li class="list-group-item">
                                        <strong>Jenis Langganan:</strong> {{ ucfirst($status->subscription_type) }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Tanggal Mulai:</strong>
                                        {{ \Carbon\Carbon::parse($subscriptionData[$status->id]->waktu_beli)->format('d M Y') }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Tanggal Habis:</strong>
                                        {{ \Carbon\Carbon::parse($subscriptionData[$status->id]->waktu_habis)->format('d M Y') }}
                                    </li>
                                @endif
                            </ul>

                            @if ($status->payment_status === 'approved' && isset($subscriptionData[$status->id]))
                                <button wire:click="kirimInvoice({{ $status->id }})" class="btn btn-success"
                                    wire:loading.attr="disabled">
                                    <span wire:loading.remove>Kirim Invoice ke WhatsApp</span>
                                    <span wire:loading>Kirim...</span>
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach

                @if (session()->has('message'))
                    <div class="alert alert-success mt-3">
                        {{ session('message') }}
                    </div>
                @endif

                @error('error')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
            @endif
        @endif
    </div>
</main>

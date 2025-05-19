<main>
    @section('head')
        @include('components.partials.head-status')
    @endsection
    @section('nav')
        @include('components.partials.nav-status')
    @endsection
    <div class="container py-5">
        <h1 class="mb-4">Cek Status Langganan TeamAnuBot</h1>

        @if ($error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endif

        <form wire:submit.prevent="cek">
            <div class="mb-3">
                <label for="search" class="form-label">Masukkan ID atau Nama</label>
                <input type="text" class="form-control" id="search" wire:model="search"
                    placeholder="Masukkan ID atau Nama">
            </div>
            <button type="submit" class="btn btn-primary">Cek Status</button>
        </form>

        @if ($status)
            <hr>
            <h3>Hasil Pencarian untuk: {{ $status->name }} (ID: {{ $status->id }})</h3>
            <ul class="list-group mt-3">
                <li class="list-group-item"><strong>Nama:</strong> {{ $status->name }}</li>
                <li class="list-group-item"><strong>Status Pembayaran:</strong>
                    @if ($status->payment_status == 'pending')
                        <span class="badge-status badge-pending">Pending</span>
                    @elseif ($status->payment_status == 'approved')
                        <span class="badge-status badge-approved">Approved</span>
                    @else
                        <span class="badge-status badge-rejected">Rejected</span>
                    @endif
                </li>

                @if ($status->payment_status == 'approved' && $subscription)
                    <li class="list-group-item"><strong>Jenis Langganan:</strong>
                        {{ ucfirst($status->subscription_type) }}
                    </li>
                    <li class="list-group-item"><strong>Tanggal Mulai:</strong>
                        {{ \Carbon\Carbon::parse($subscription->waktu_beli)->format('d M Y') }}</li>
                    <li class="list-group-item"><strong>Tanggal Habis:</strong>
                        {{ \Carbon\Carbon::parse($subscription->waktu_habis)->format('d M Y') }}</li>
                @endif
            </ul>
        @endif
    </div>
</main>

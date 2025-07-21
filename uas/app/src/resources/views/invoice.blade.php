<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Langganan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
         body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .invoice-box {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 50px auto;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #0d6efd;
        }
        .company-info {
            text-align: right;
        }
        .table th {
            background-color: #f1f3f5;
            color: #495057;
        }
        .table td {
            color: #343a40;
        }
        .table tfoot td {
            font-weight: bold;
            background-color: #e9ecef;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            margin-top: 40px;
        }
        .icon {
            margin-right: 8px;
            color: #0d6efd;
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <div class="invoice-header">
        <div>
            <div class="invoice-title"><i class="fas fa-file-invoice icon"></i>Invoice Langganan</div>
            <small class="text-muted">Tanggal Cetak: {{ date('d M Y') }}</small>
        </div>
        <div class="company-info">
            <img src="{{ public_path('front/images/tab.jpeg') }}" alt="Logo" style="max-height: 150px;"><br>
            <strong>TeamAnuBot</strong><br>
            <span class="text-muted">Jl. Teknologi No. 123<br>Jakarta, Indonesia</span><br>
            <span class="text-muted"><i class="fas fa-phone icon"></i>081297355541</span>
        </div>
    </div>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <th><i class="fas fa-user icon"></i>Nama</th>
                <td>{{ $status->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-star icon"></i>Jenis Langganan</th>
                <td>{{ ucfirst($status->subscription_type) }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-credit-card icon"></i>Status Pembayaran</th>
                <td>{{ ucfirst($status->payment_status) }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-calendar-alt icon"></i>Masa Berlaku</th>
                <td>{{ $waktu_beli }} s/d {{ $waktu_habis }}</td>
            </tr>
            <tr>
                <th><i class="fas fa-money-bill-wave icon"></i>Harga</th>
                <td>Rp {{ number_format($status->price, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="alert alert-info mt-4" role="alert">
        <i class="fas fa-info-circle"></i> Invoice ini dibuat otomatis oleh sistem. Simpan sebagai bukti pembayaran.
    </div>

    <div class="footer">
        Jika ada pertanyaan, hubungi admin melalui WhatsApp di <strong>081297355541</strong>.<br>
        &copy; 2025 <strong>TeamAnuBot</strong> - Semua hak dilindungi.
    </div>
</div>

</body>
</html>
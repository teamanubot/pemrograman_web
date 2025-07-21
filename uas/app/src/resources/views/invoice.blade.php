<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Langganan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .invoice-box {
            max-width: 700px;
            margin: 40px auto;
            padding: 30px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }
        h2.title {
            text-align: center;
            margin-bottom: 25px;
            color: #0d6efd;
            font-weight: 700;
        }
        .table th {
            background-color: #f1f3f5;
            color: #495057;
            width: 40%;
        }
        .table td {
            color: #495057;
        }
        .table tr:last-child td {
            font-weight: bold;
            background-color: #e9ecef;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>
<body>

    <div class="invoice-box">
        <h2 class="title">Invoice Langganan</h2>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <th>{{ $status->nama ?? '-' }}</th>
                </tr>
                <tr>
                    <th>Jenis Langganan</th>
                    <th>{{ ucfirst($status->subscription_type) }}</th>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <th>{{ ucfirst($status->payment_status) }}</th>
                </tr>
                <tr>
                    <th>Masa Berlaku</th>
                    <th>{{ $waktu_beli }} s/d {{ $waktu_habis }}</th>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>Rp {{ number_format($status->price, 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Invoice ini dibuat secara otomatis oleh sistem.</p>
            <p>Jika ada pertanyaan, hubungi admin melalui WhatsApp di <strong>081297355541</strong>.</p>
            <p>&copy; 2025 <strong>TeamAnuBot</strong></p>
        </div>
    </div>

</body>
</html> 
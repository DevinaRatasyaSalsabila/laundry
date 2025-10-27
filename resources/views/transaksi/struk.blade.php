<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk - SiLaundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">

    <style>
        @page {
            size: 80mm auto;
            margin: 0;
        }

        body {
            width: 80mm;
            margin: 0 auto;
            background: #fff;
            font-size: 11px;
            font-family: 'Consolas', 'Lucida Console', 'DejaVu Sans Mono', monospace;
        }

        .container-struk {
            padding: 10px;
        }

        .logo {
            width: 55px;
            height: 55px;
            object-fit: contain;
            display: block;
            margin: 0 auto 5px;
        }

        h6 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .alamat {
            font-size: 10px;
            margin-bottom: 8px;
        }

        hr {
            border-top: 1px dashed #000;
            margin: 6px 0;
        }

        .info-transaksi p {
            margin: 0;
            line-height: 1.3;
        }

        .table th,
        .table td {
            padding: 3px 0;
            font-size: 11px;
        }

        .table thead th {
            border-bottom: 1px dashed #000;
        }

        .table tfoot td {
            border-top: 1px dashed #000;
        }

        .text-small {
            font-size: 10px;
        }

        @media print {
            .btn-print {
                display: none;
            }

            body {
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container-struk text-center">
        <!-- Logo & Header -->
        <img src="{{ asset('logo/logo1.jpg') }}" class="logo" alt="Logo Laundry">
        <h6>SILAUNDRY</h6>
        <p class="alamat">Jl. Raya Blitar No.123, Blitar</p>

        <hr>

        <!-- Info Transaksi -->
        <div class="text-start info-transaksi mb-2">
            <p><strong>Nama:</strong> {{ $transaksi->nama_pelanggan }}</p>
            <p><strong>Tanggal:</strong>
                {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}</p>
            <p><strong>Status:</strong> {{ $transaksi->status }}</p>
        </div>

        <hr>

        <!-- Detail Layanan -->
        <table class="table table-borderless table-sm mb-1">
            <thead>
                <tr>
                    <th class="text-start">Layanan</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail as $d)
                    <tr>
                        <td class="text-start">
                            {{ $d->nama_layanan }}<br>
                            <span class="text-small">{{ $d->berat }} Kg ×
                                Rp{{ number_format($d->harga_satuan, 0, ',', '.') }}</span>
                        </td>
                        <td class="text-end">Rp{{ number_format($d->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="fw-bold text-start">TOTAL</td>
                    <td class="fw-bold text-end">Rp{{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <hr>

        <!-- Footer -->
        <p class="text-center text-small mb-1">
            Terima kasih telah menggunakan layanan kami <br>
            Dicetak: {{ date('d M Y H:i') }}
        </p>

        <!-- Tombol Print -->
        <button class="btn btn-secondary btn-sm w-100 btn-print mt-2" onclick="window.print()">
            <i class="bi bi-printer"></i>
            Cetak Struk
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

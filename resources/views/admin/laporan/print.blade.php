
<!DOCTYPE html>
<html>
<head>
    <title>Print Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 30px;
            color: #333;
        }

        .bill {
            width: 400px;
            margin: auto;
            background: white;
            border: 1px solid #dcdcdc;
            border-radius: 12px;
            padding: 25px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #16a34a;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            color: #16a34a;
            font-size: 22px;
        }

        .header p {
            margin-top: 8px;
            font-size: 13px;
            color: #666;
            line-height: 1.5;
        }

        .info {
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e5e5e5;
            font-size: 14px;
        }

        .info-row span:first-child {
            font-weight: bold;
            color: #444;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #777;
        }

        .btn-print {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background: #16a34a;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-print:hover {
            background: #15803d;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .bill {
                border: none;
                box-shadow: none;
            }

            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="bill">
    <div class="header">
        <img src="{{ asset('images/Logo.jpeg') }}" alt="Logo">
        <h2>CASA DE LITERACY</h2>
        <p>
           Jl.Cikini Raya No. 73, Komplek Taman Ismail Marzuki (TIM)<br>
            Cikini, Menteng,Jakarta Pusat 10330
        </p>
    </div>

    <div class="info">
        <div class="info-row">
            <span>Nama</span>
            <span>{{ $borrowing->user->name }}</span>
        </div>

        <div class="info-row">
            <span>Buku</span>
            <span>{{ $borrowing->book->judul }}</span>
        </div>

        <div class="info-row">
            <span>Tgl Pinjam</span>
            <span>{{ $borrowing->tanggal_pinjam }}</span>
        </div>

        <div class="info-row">
            <span>Tgl Kembali</span>
            <span>{{ $borrowing->tanggal_kembali }}</span>
        </div>
    </div>

    <div class="footer">
        Terima kasih telah menggunakan layanan kami.
    </div>
</div>

<button onclick="window.print()" class="btn-print">
    Cetak
</button>

</body>
</html>

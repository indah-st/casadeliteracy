<!DOCTYPE html>
<html>
<head>
    <title>Print Laporan</title>
    <style>
        body {
            font-family: monospace;
        }

        .bill {
            width: 350px;
            margin: auto;
            border: 1px solid #000;
            padding: 20px;
        }

        .center {
            text-align: center;
        }

        hr {
            border: 1px dashed #000;
        }

        .btn-print {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
        }

        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="bill">
    <div class="center">
       <img src="{{ asset('images/Logo.jpeg') }}" style="width: 80px; height: 80px; object-fit: contain;"><br>
        <strong>CASA DE LITERACY</strong><br>
        Jl. Malioboro No. 101, Sosromenduran, Gedong Tengen, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55271.</p>
        <br>
    </div>

    <hr>

    <p>Nama: {{ $borrowing->user->name }}</p>
    <p>Buku: {{ $borrowing->book->judul }}</p>
    <p>Tgl Pinjam: {{ $borrowing->tanggal_pinjam }}</p>
    <p>Tgl Kembali: {{ $borrowing->tanggal_kembali }}</p>

    <hr>

    <div class="center">
        Terima kasih
    </div>
</div>

<button onclick="window.print()" class="btn-print">
    🖨️ Cetak
</button>

</body>
</html>
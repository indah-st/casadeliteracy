<!DOCTYPE html>
<html>
<head>
    <title>Print Laporan Semua</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 30px;
            color: #333;
        }
        .page {
            width: 100%;
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
        .header h2 {
            margin: 0;
            color: #16a34a;
            font-size: 24px;
        }
        .header p {
            margin-top: 8px;
            font-size: 13px;
            color: #666;
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #e5e5e5;
            padding: 10px;
            text-align: left;
            font-size: 13px;
        }
        th {
            background: #f0fdf4;
            color: #166534;
            font-weight: 700;
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
            .page {
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
<div class="page">
    <div class="header">
        <h2>CASA DE LITERACY</h2>
        <p>Jl. Cikini Raya No. 73, Komplek Taman Ismail Marzuki (TIM)<br>Cikini, Menteng, Jakarta Pusat 10330</p>
    </div>
    <h3>Daftar Laporan Peminjaman</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowings as $index => $borrowing)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $borrowing->user->name }}</td>
                    <td>{{ $borrowing->book->judul }}</td>
                    <td>{{ $borrowing->tanggal_pinjam }}</td>
                    <td>{{ $borrowing->tanggal_kembali }}</td>
                    <td>{{ ucfirst($borrowing->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<button onclick="window.print()" class="btn-print">Cetak</button>
</body>
</html>

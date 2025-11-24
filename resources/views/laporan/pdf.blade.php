<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pendapatan - AUSAA'S LAUNDRY</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #7e22ce;
        }
        .header h1 {
            color: #7e22ce;
            font-size: 24px;
            margin: 0 0 5px 0;
        }
        .header h2 {
            color: #666;
            font-size: 16px;
            margin: 0;
            font-weight: normal;
        }
        .summary {
            margin-bottom: 30px;
            display: table;
            width: 100%;
        }
        .summary-item {
            display: table-cell;
            width: 33.33%;
            padding: 15px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            text-align: center;
        }
        .summary-item h3 {
            color: #6b7280;
            font-size: 11px;
            margin: 0 0 8px 0;
            text-transform: uppercase;
        }
        .summary-item p {
            color: #1f2937;
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }
        .meta {
            text-align: right;
            color: #6b7280;
            font-size: 11px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table thead {
            background: #7e22ce;
            color: white;
        }
        table th {
            padding: 10px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: bold;
        }
        table td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
        }
        table tbody tr:nth-child(even) {
            background: #f9fafb;
        }
        table tfoot {
            background: #f3f4f6;
            border-top: 2px solid #7e22ce;
        }
        table tfoot td {
            padding: 12px 10px;
            font-weight: bold;
            font-size: 13px;
            color: #7e22ce;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 10px;
        }
        .no-data {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>AUSAA'S LAUNDRY</h1>
        <h2>Laporan Pendapatan</h2>
    </div>

    <div class="meta">
        Dicetak pada: {{ date('d F Y, H:i') }}
    </div>

    <div class="summary">
        <div class="summary-item">
            <h3>Total Pendapatan</h3>
            <p>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="summary-item">
            <h3>Bulan Ini</h3>
            <p>Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
        </div>
        <div class="summary-item">
            <h3>Total Transaksi</h3>
            <p>{{ $totalTransaksi }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>ID Transaksi</th>
                <th>Pelanggan</th>
                <th>Jenis Cucian</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $item)
            <tr>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                <td>#TRX-{{ str_pad($item->id_laporan, 4, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $item->pembayaran->pesanan->nama_pelanggan ?? '-' }}</td>
                <td>{{ $item->pembayaran->pesanan->jenis_cucian ?? '-' }}</td>
                <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="no-data">Tidak ada data laporan</td>
            </tr>
            @endforelse
        </tbody>
        @if($laporan->count() > 0)
        <tfoot>
            <tr>
                <td colspan="4" class="text-right">TOTAL KESELURUHAN:</td>
                <td class="text-right">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis oleh sistem AUSAA'S LAUNDRY</p>
        <p>{{ date('Y') }} &copy; AUSAA'S LAUNDRY - Semua hak dilindungi</p>
    </div>
</body>
</html>

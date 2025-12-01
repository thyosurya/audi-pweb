<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Harian - AUSAA'S LAUNDRY</title>
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
            border-bottom: 3px solid #ec4899;
        }
        .header h1 {
            color: #ec4899;
            font-size: 24px;
            margin: 0 0 5px 0;
        }
        .header h2 {
            color: #666;
            font-size: 16px;
            margin: 0;
            font-weight: normal;
        }
        .date-badge {
            background: #fce7f3;
            color: #be185d;
            padding: 8px 16px;
            border-radius: 8px;
            display: inline-block;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .summary {
            margin-bottom: 30px;
            display: table;
            width: 100%;
        }
        .summary-item {
            display: table-cell;
            width: 50%;
            padding: 15px;
            background: #fce7f3;
            border: 1px solid #f9a8d4;
            text-align: center;
        }
        .summary-item h3 {
            color: #be185d;
            font-size: 11px;
            margin: 0 0 8px 0;
            text-transform: uppercase;
        }
        .summary-item p {
            color: #831843;
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
            background: #ec4899;
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
            background: #fce7f3;
        }
        table tfoot {
            background: #f3f4f6;
            border-top: 2px solid #ec4899;
        }
        table tfoot td {
            padding: 12px 10px;
            font-weight: bold;
            font-size: 13px;
            color: #ec4899;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .no-data {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
            font-style: italic;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #9ca3af;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>AUSAA'S LAUNDRY</h1>
        <h2>Laporan Pendapatan Harian</h2>
    </div>

    <div class="text-center">
        <div class="date-badge">{{ $tanggal }}</div>
    </div>

    <div class="meta">
        Dicetak pada: {{ date('d F Y H:i') }}
    </div>

    <div class="summary">
        <div class="summary-item">
            <h3>Total Pendapatan Hari Ini</h3>
            <p>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="summary-item">
            <h3>Total Transaksi</h3>
            <p>{{ $totalTransaksi }} Transaksi</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Waktu</th>
                <th>ID Transaksi</th>
                <th>Pelanggan</th>
                <th>Jenis Cucian</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $item)
            <tr>
                <td>{{ $item->created_at->format('H:i') }}</td>
                <td>#TRX-{{ str_pad($item->id_laporan, 4, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $item->pembayaran->pesanan->nama_pelanggan ?? '-' }}</td>
                <td>{{ $item->pembayaran->pesanan->jenis_cucian ?? '-' }}</td>
                <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="no-data">
                    Tidak ada transaksi pada hari ini
                </td>
            </tr>
            @endforelse
        </tbody>
        @if($laporan->count() > 0)
        <tfoot>
            <tr>
                <td colspan="4" class="text-right">Total Pendapatan Hari Ini:</td>
                <td class="text-right">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="footer">
        <p>Dokumen ini dibuat secara otomatis oleh sistem AUSAA'S LAUNDRY</p>
        <p>© {{ date('Y') }} AUSAA'S LAUNDRY. All rights reserved.</p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak BOM - {{ $barang->nama_barang }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #fff;
            color: #1a1a1a;
            font-size: 11px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .print-container {
            width: 210mm;
            min-height: 297mm;
            padding: 18mm 20mm 15mm 20mm;
            background: #fff;
            margin: 0 auto;
        }

        /* ========== HEADER ========== */
        .header {
            text-align: center;
            border-bottom: 2px solid #1a1a1a;
            padding-bottom: 6px;
            margin-bottom: 12px;
        }
        .header h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #1a1a1a;
        }
        .header .sub {
            font-family: 'Inter', sans-serif;
            font-size: 11px;
            font-weight: 500;
            color: #555;
            margin-top: 1px;
            letter-spacing: 3px;
        }

        /* ========== INFO ========== */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2px 30px;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #ccc;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 2px 0;
            border-bottom: 1px dashed #e8e8e8;
        }
        .info-item .label {
            font-family: 'Inter', sans-serif;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #777;
        }
        .info-item .value {
            font-family: 'Inter', sans-serif;
            font-size: 11px;
            font-weight: 600;
            color: #1a1a1a;
        }

        /* ========== TABEL ========== */
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Inter', sans-serif;
            font-size: 10px;
            margin-top: 4px;
        }
        thead th {
            background: #e8e8e8;
            color: #1a1a1a;
            padding: 6px 10px;
            text-align: center;
            font-weight: 700;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border: 1px solid #aaa;
        }
        thead th:first-child { width: 10%; }
        thead th:nth-child(2) { width: 34%; }
        thead th:nth-child(3) { width: 10%; }
        thead th:nth-child(4) { width: 10%; }
        thead th:nth-child(5) { width: 18%; }
        thead th:last-child { width: 18%; }

        tbody td {
            padding: 4px 10px;
            text-align: center;
            border: 1px solid #ccc;
            font-size: 10px;
            color: #1a1a1a;
        }
        tbody td:nth-child(2) {
            text-align: left;
        }
        tbody tr:nth-child(even) {
            background: #f6f6f6;
        }

        /* ========== TOTAL HPP ========== */
        .total-row td {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            border-top: 2px solid #1a1a1a;
            padding: 5px 10px;
            background: #f0f0f0;
        }
        .total-row .total-label {
            text-align: right;
            font-size: 11px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: #1a1a1a;
        }
        .total-row .total-amount {
            font-size: 13px;
            font-weight: 700;
            color: #1a1a1a;
        }

        /* ========== TOTAL MATERIAL AMOUNT ========== */
        .total-material {
            margin-top: 8px;
            text-align: right;
            font-family: 'Inter', sans-serif;
            border-top: 2px solid #1a1a1a;
            padding-top: 8px;
        }
        .total-material .label {
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #1a1a1a;
        }
        .total-material .amount {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 14px;
            margin-left: 12px;
            color: #1a1a1a;
        }

        /* ========== FOOTER ========== */
        .footer {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            font-family: 'Inter', sans-serif;
            font-size: 9px;
            color: #888;
            border-top: 1px solid #ccc;
            padding-top: 8px;
        }

        /* ========== TOMBOL CETAK ========== */
        .no-print {
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            background: #f5f5f5;
            border-radius: 8px;
        }
        .no-print .btn-print {
            padding: 8px 28px;
            background: #1a1a1a;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 11px;
            cursor: pointer;
            transition: 0.2s;
        }
        .no-print .btn-print:hover {
            background: #333;
        }
        .no-print .btn-close {
            padding: 8px 28px;
            background: #dc3545;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 11px;
            cursor: pointer;
            margin-left: 10px;
            transition: 0.2s;
        }
        .no-print .btn-close:hover {
            background: #c82333;
        }

        @media print {
            .no-print { display: none !important; }
            body { padding: 0; margin: 0; }
            .print-container {
                width: 100%;
                min-height: auto;
                padding: 15mm 18mm 12mm 18mm;
            }
            thead th {
                background: #e8e8e8 !important;
                color: #1a1a1a !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            tbody tr:nth-child(even) {
                background: #f6f6f6 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .total-row td {
                background: #f0f0f0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .info-grid { border-bottom: 1px solid #1a1a1a; }
            .footer { border-top: 1px solid #1a1a1a; }
            .total-material { border-top: 2px solid #1a1a1a; }
            .header { border-bottom: 2px solid #1a1a1a; }
        }
    </style>
</head>
<body>
    <div class="print-container">

        <!-- ========== HEADER ========== -->
        <div class="header">
            <h1>Bill of Material</h1>
            <div class="sub">Gallery Namia</div>
        </div>

        <!-- ========== INFO ========== -->
        <div class="info-grid">
            <div class="info-item">
                <span class="label">No. BOM</span>
                <span class="value">{{ $barang->no_barang }}</span>
            </div>
            <div class="info-item">
                <span class="label">Deskripsi Produk</span>
                <span class="value">{{ $barang->no_barang }} : {{ $barang->nama_barang }}</span>
            </div>
            <div class="info-item">
                <span class="label">Ukuran</span>
                <span class="value">{{ $barang->ukuran }}</span>
            </div>
            <div class="info-item">
                <span class="label">Stok</span>
                <span class="value">{{ number_format($barang->stok_barang, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- ========== TABEL ========== -->
        <table>
            <thead>
                <tr>
                    <th>Nomor Bahan</th>
                    <th>Nama Bahan Baku</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse($detailBarang as $d)
                <tr>
                    <td>{{ $d->no_bahan }}</td>
                    <td>{{ $d->bahanBaku->nama_bahan ?? '-' }}</td>
                    <td>{{ number_format($d->qty_pakai, 0, ',', '.') }}</td>
                    <td>{{ $d->bahanBaku->satuan ?? '-' }}</td>
                    <td>Rp {{ number_format($d->bahanBaku->harga_beli ?? 0, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($d->subtotal_bom, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:10px; color:#999;">
                        <i>Belum ada bahan baku untuk barang ini.</i>
                    </td>
                </tr>
                @endforelse

                <!-- TOTAL HPP -->
                <tr class="total-row">
                    <td colspan="5" class="total-label">
                        <strong>Total HPP</strong>
                    </td>
                    <td class="total-amount">
                        <strong>Rp {{ number_format($totalHpp, 0, ',', '.') }}</strong>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- ========== TOTAL MATERIAL AMOUNT ========== -->
        <div class="total-material">
            <span class="label">Total Biaya Bahan Baku</span>
            <span class="amount">Rp {{ number_format($totalHpp, 0, ',', '.') }}</span>
        </div>

        <!-- ========== FOOTER ========== -->
        <div class="footer">
            <span>Dicetak oleh: {{ auth()->user()->name ?? 'Admin' }}</span>
            <span>Tanggal: {{ now()->format('d/m/Y H:i') }}</span>
        </div>

        <!-- ========== TOMBOL ========== -->
        <div class="no-print">
            <button class="btn-print" onclick="window.print()">
                <i class="fas fa-print"></i> Cetak
            </button>
            <button class="btn-close" onclick="window.close()">
                <i class="fas fa-times"></i> Tutup
            </button>
        </div>

    </div>
</body>
</html>
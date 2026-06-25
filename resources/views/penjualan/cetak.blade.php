<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Penjualan - Gallery Namia</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            padding: 20px;
            position: relative;
        }
        .nota-container {
            background: white;
            width: 800px;
            min-height: 1000px;
            padding: 30px 35px 40px 35px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .print-button-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        .btn-print-popup {
            background: linear-gradient(95deg, #ffb347, #ff8c1a);
            border: none;
            padding: 10px 25px;
            border-radius: 40px;
            color: white;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            font-family: inherit;
            box-shadow: 0 4px 12px rgba(255, 140, 26, 0.3);
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-print-popup:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(255, 140, 26, 0.4);
        }
        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        .logo-area {
            display: flex;
            align-items: flex-start;
        }
        .logo-small {
            max-height: 60px;
            width: auto;
            border-right: 2px solid black;
            padding-right: 10px;
        }
        .nama-toko-wrapper {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: -5px;
        }
        .text-small {
            max-height: 40px;
            width: auto;
            margin-left: 16px;
            margin-bottom: 5px;
        }
        .logo-details {
            font-size: 9px;
            line-height: 1.4;
            color: #333;
            text-align: left;
            margin-top: -5px;
            margin-left: 16px;
        }
        .customer-info {
            text-align: left;
            min-width: 320px;
        }
        .info-row {
            display: flex;
            align-items: baseline;
            margin-bottom: 6px;
        }
        .info-label {
            min-width: 65px;
            font-weight: normal;
        }
        .dotted-line {
            flex: 1;
            border-bottom: 1px dotted #000;
            margin-left: 8px;
            height: 18px;
        }
        .nota-number {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 22px;
        }
        .nota-left {
            display: flex;
            align-items: baseline;
        }
        .nota-left span {
            border-bottom: 1px dotted #000;
            width: 260px;
            margin-left: 12px;
            height: 26px;
        }
        .right-lines {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        .dotted-right {
            border-bottom: 1px dotted #000;
            width: 180px;
            height: 18px;
        }
        .solid-right {
            border-bottom: 1px solid #000;
            width: 180px;
            height: 2px;
            margin-top: 2px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-top: 1px solid black;
            border-right: 1px solid black;
        }
        th, td {
            border: 1px solid black;
            padding: 6px 8px;
        }
        th {
            text-align: center;
            font-weight: normal;
            font-size: 15px;
        }
        td {
            vertical-align: top;
        }
        .col-qty {
            width: 13%;
            text-align: center;
        }
        .col-nama {
            width: 42%;
        }
        .col-harga {
            width: 18%;
            text-align: right;
        }
        .col-subtotal {
            width: 22%;
            text-align: right;
        }
        .total-row td, .extra-row td {
            border: none;
            height: 38px;
        }
        .label-right {
            text-align: right;
            padding-right: 15px;
            font-weight: bold;
            font-size: 16px;
        }
        .value-box {
            border: 1px solid black !important;
            width: 22%;
            text-align: right;
            padding-right: 10px;
            font-weight: bold;
        }
        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            padding: 0 40px;
        }
        .sign-item {
            text-align: center;
            width: 200px;
        }
        .sign-space {
            height: 70px;
        }
        .sign-name {
            margin-top: 5px;
            font-weight: bold;
        }
        @media print {
            body { background: white; padding: 0; }
            .nota-container { box-shadow: none; padding: 20px; }
            .print-button-container { display: none; }
        }
    </style>
</head>
<body>
    <div class="print-button-container">
        <button type="button" class="btn-print-popup" onclick="window.print();">🖨️ Cetak / Print</button>
    </div>

    <div class="nota-container">
        <div class="header-row">
            <div class="logo-area">
                <img src="{{ asset('images/logo1.png') }}" alt="Logo GN" class="logo-small">
                <div class="nama-toko-wrapper">
                    <img src="{{ asset('images/teks.png') }}" alt="GALLERY NAMIA" class="text-small">
                    <div class="logo-details">
                        Cibodas Raya No 20 D, Karawaci Tangerang<br>
                        0857 1610 7394
                    </div>
                </div>
            </div>
            <div class="customer-info">
                <div class="info-row">
                    <span class="info-label">Tanggal :</span>
                    <div class="dotted-line">{{ date('d/m/Y', strtotime($penjualan->tgl_jual)) }}</div>
                </div>
                <div class="info-row">
                    <span class="info-label">Kepada :</span>
                    <div class="dotted-line">{{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <span class="info-label">Kontak :</span>
                    <div class="dotted-line">{{ $penjualan->pelanggan->tlp_pelanggan ?? '' }}</div>
                </div>
                <div class="info-row">
                    <span class="info-label">Email :</span>
                    <div class="dotted-line">{{ $penjualan->pelanggan->email_pelanggan ?? '' }}</div>
                </div>
            </div>
        </div>

        <div class="nota-number">
            <div class="nota-left">
                NOTA No. <span>{{ $penjualan->no_jual }}</span>
            </div>
            <div class="right-lines">
                <div class="dotted-right"></div>
                <div class="solid-right"></div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th class="col-qty">BANYAKNYA</th>
                    <th class="col-nama">NAMA BARANG</th>
                    <th class="col-harga">HARGA</th>
                    <th class="col-subtotal">JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualan->detailPenjualan as $item)
                <tr>
                    <td class="col-qty">{{ number_format($item->qty_jual, 0, ',', '.') }}</td>
                    <td class="col-nama">{{ $item->barang->nama_barang ?? '-' }} ({{ $item->barang->ukuran ?? '-' }})</td>
                    <td class="col-harga">Rp {{ number_format($item->barang->harga_barang ?? 0, 0, ',', '.') }}</td>
                    <td class="col-subtotal">Rp {{ number_format($item->subtotal_jual, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <?php
                $emptyRows = 12 - $penjualan->detailPenjualan->count();
                for ($i = 0; $i < $emptyRows; $i++) {
                    echo '<tr><td class="col-qty">&nbsp;</td><td class="col-nama">&nbsp;</td><td class="col-harga">&nbsp;</td><td class="col-subtotal">&nbsp;</td></tr>';
                }
                ?>
                <tr class="total-row">
                    <td colspan="2"></td>
                    <td class="label-right">Jumlah Rp.</td>
                    <td class="value-box">Rp {{ number_format($penjualan->total_jual, 0, ',', '.') }}</td>
                </tr>
                <tr class="extra-row">
                    <td colspan="2"></td>
                    <td class="label-right">DP 30%</td>
                    <td class="value-box">Rp {{ number_format($penjualan->dp, 0, ',', '.') }}</td>
                </tr>
                <tr class="extra-row">
                    <td colspan="2"></td>
                    <td class="label-right">Sisa Bayar</td>
                    <td class="value-box">Rp {{ number_format($penjualan->sisa_bayar, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="signature">
            <div class="sign-item">
                <div>Tanda Terima</div>
                <div class="sign-space"></div>
                <div class="sign-name">( {{ $penjualan->pelanggan->nama_pelanggan ?? '-' }} )</div>
            </div>
            <div class="sign-item">
                <div>Hormat kami,</div>
                <div class="sign-space"></div>
                <div class="sign-name">( {{ $penjualan->pegawai->nama_pegawai ?? '-' }} )</div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
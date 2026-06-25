<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Detail Barang - Gallery Namia</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* ========== CSS SAMA PERSIS DENGAN SEBELUMNYA ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f2f8;
            overflow-x: hidden;
            font-size: 13px;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 240px;
            min-width: 240px;
            max-width: 240px;
            background: linear-gradient(145deg, #0f2b3d 0%, #1a3f55 100%);
            color: #fff;
            transition: all 0.3s ease;
            box-shadow: 8px 0 25px rgba(0, 0, 0, 0.08);
            z-index: 1000;
            border-radius: 0 20px 20px 0;
            overflow-y: auto;
        }

        #sidebar.active {
            margin-left: -240px;
        }

        #sidebar .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            margin: 0 auto 15px auto;
            background-size: cover;
            background-position: center;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.35);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        #sidebar ul.components {
            padding: 0.8rem 0;
        }

        #sidebar ul li {
            margin: 0.2rem 0.6rem;
            border-radius: 12px;
            transition: all 0.2s;
        }

        #sidebar ul li a {
            padding: 8px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #eef4ff;
            border-radius: 12px;
            transition: 0.2s;
            text-decoration: none;
        }

        #sidebar ul li a i {
            width: 20px;
            font-size: 1rem;
            text-align: center;
        }

        #sidebar ul li.active,
        #sidebar ul li:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        #sidebar ul li.active a {
            color: white;
            font-weight: 600;
            background: linear-gradient(95deg, #ffb347, #ff8c1a);
        }

        #content {
            width: 100%;
            background: #f4f7fc;
            transition: all 0.3s;
            min-height: 100vh;
            margin-left: 240px;
            width: calc(100% - 240px);
            overflow-y: auto;
        }

        #sidebar.active~#content {
            margin-left: 0;
            width: 100%;
        }

        .navbar-custom {
            background: white;
            border-radius: 20px;
            padding: 0.4rem 1.2rem;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.03);
            margin-bottom: 1.5rem;
        }

        .btn-toggle {
            background: #1f5e7e;
            border: none;
            color: white;
            border-radius: 30px;
            padding: 5px 14px;
            font-weight: 500;
            font-size: 0.75rem;
            cursor: pointer;
        }

        .btn-toggle:hover {
            background: #0f4a64;
        }

        .page-header {
            margin-bottom: 1.5rem;
        }

        .page-header h2 {
            font-weight: 700;
            font-size: 1.5rem;
            color: #1e2f3a;
            position: relative;
            display: inline-block;
        }

        .page-header h2:after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 45px;
            height: 3px;
            background: linear-gradient(90deg, #ff8c1a, #ffb347);
            border-radius: 3px;
        }

        .form-card {
            border: none;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 22px -8px rgba(0, 32, 64, 0.08);
            overflow: hidden;
            transition: all 0.25s ease;
            margin-top: 0.8rem;
            margin-bottom: 1.5rem;
        }

        .form-card .card-header-custom {
            background: transparent;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #eef2f7;
        }

        .form-card .card-header-custom h3 {
            font-weight: 700;
            color: #1c3f4f;
            margin: 0;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-card .card-header-custom h3 i {
            color: #ff8c1a;
            font-size: 1.4rem;
        }

        .form-card .card-body-custom {
            padding: 1.5rem;
        }

        .form-group-custom {
            margin-bottom: 1rem;
        }

        .form-group-custom label {
            font-weight: 600;
            color: #2c5a6e;
            margin-bottom: 0.3rem;
            font-size: 0.75rem;
            letter-spacing: 0.3px;
            display: block;
        }

        .form-group-custom label i {
            margin-right: 6px;
            color: #ff8c1a;
            width: 20px;
        }

        .form-control-custom {
            width: 100%;
            padding: 8px 14px;
            font-size: 0.8rem;
            font-weight: 500;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            transition: all 0.2s;
            background: #fefefe;
            font-family: 'Poppins', sans-serif;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: #ff8c1a;
            box-shadow: 0 0 0 3px rgba(255, 140, 26, 0.1);
        }

        .form-control-custom[readonly] {
            background: #f5f7fb;
            color: #6c7e8f;
            border-color: #e9ecef;
        }

        .form-row-custom {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .card-table {
            border: none;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 22px -8px rgba(0, 32, 64, 0.08);
            overflow: hidden;
            margin-top: 0.8rem;
            margin-bottom: 1.5rem;
        }

        .card-table .card-header-custom {
            background: transparent;
            padding: 0.8rem 1.2rem;
            border-bottom: 1px solid #eef2f7;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.8rem;
        }

        .card-table .card-header-custom h5 {
            font-weight: 600;
            color: #1c3f4f;
            margin: 0;
            font-size: 1rem;
        }

        .data-table-wrapper {
            padding: 0 0.8rem 0.8rem 0.8rem;
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead th {
            background: #f8fafd;
            color: #1e4a62;
            font-weight: 600;
            font-size: 0.65rem;
            text-transform: uppercase;
            padding: 10px 8px;
            border-bottom: 2px solid #e2e8f0;
            text-align: center !important;
            border-right: 1px solid #e9ecef;
        }

        .data-table thead th:last-child {
            border-right: none;
        }

        .data-table tbody td {
            padding: 8px 8px;
            vertical-align: middle;
            color: #2c3e4e;
            border-bottom: 1px solid #ecf3f8;
            text-align: center;
            border-right: 1px solid #f0f2f5;
            font-size: 0.7rem;
        }

        .data-table tbody td:last-child {
            border-right: none;
        }

        .data-table tbody tr:hover {
            background-color: #fef9ef;
        }

        .total-row {
            background-color: #fef9ef;
            border-top: 2px solid #ff8c1a;
        }

        .total-row td {
            font-weight: 600;
            padding: 10px 8px;
            border: none;
        }

        .total-row .total-label {
            text-align: center;
            font-weight: 400;
            color: #1c3f4f;
        }

        .total-row .total-amount {
            text-align: center;
            font-weight: 400;
            color: #ff8c1a;
            background: white;
            border-radius: 8px;
            font-size: 0.85rem;
            padding: 6px 12px;
        }

        .btn-sm-action {
            border-radius: 30px;
            padding: 3px 8px;
            font-size: 0.6rem;
            font-weight: 500;
            margin: 0 2px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            border: none;
        }

        .btn-edit {
            background: #2c7da0;
            color: white;
        }

        .btn-edit:hover {
            background: #1f5e7e;
            transform: translateY(-1px);
            color: white;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background: #c82333;
            transform: translateY(-1px);
            color: white;
        }

        .btn-back {
            background: #dc3545;
            border: none;
            color: white;
            border-radius: 30px;
            padding: 6px 20px;
            font-weight: 600;
            font-size: 0.75rem;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-back:hover {
            background: #c82333;
            transform: translateY(-1px);
            color: white;
            text-decoration: none;
        }

        .btn-add {
            background: linear-gradient(95deg, #ffb347, #ff8c1a);
            color: white;
            border-radius: 30px;
            padding: 5px 14px;
            font-weight: 500;
            font-size: 0.7rem;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border: none;
        }

        .btn-add:hover {
            background: linear-gradient(95deg, #ffa233, #ff7a0f);
            transform: translateY(-1px);
            color: white;
        }

        .btn-print {
            background: #28a745;
            color: white;
            border-radius: 30px;
            padding: 5px 14px;
            font-size: 0.7rem;
            font-weight: 500;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-print:hover {
            background: #218838;
            transform: translateY(-1px);
            color: white;
            text-decoration: none;
        }

        .info-box {
            padding: 10px 16px;
            background: #f8fafd;
            border-radius: 12px;
            border-left: 4px solid #ff8c1a;
            display: flex;
            flex-wrap: wrap;
            gap: 10px 30px;
        }

        .info-box .info-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
        }

        .info-box .info-item strong {
            color: #1c3f4f;
            font-weight: 600;
        }

        .info-box .info-item .label {
            color: #6c7e8f;
            font-weight: 400;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: #3a5b6e;
            margin: 0 4px;
            border-radius: 30px;
            padding: 4px 12px;
            font-size: 0.7rem;
        }

        .navbar-nav .nav-link:hover {
            background: #eef2f7;
            color: #ff7a2f;
        }

        .navbar-nav .nav-link.active {
            background: #ff8c1a20;
            color: #ff7a2f;
            font-weight: 600;
        }

        .dropdown-menu {
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: none;
            padding: 8px 0;
        }

        .dropdown-item {
            font-size: 13px;
            padding: 8px 20px;
        }

        .dropdown-item i {
            width: 20px;
            margin-right: 8px;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
        }

        .back-button-container {
            margin-top: 0.8rem;
            margin-bottom: 0.8rem;
            text-align: left;
        }

        .modal-custom .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .modal-custom .modal-header {
            border-bottom: none;
            padding: 1rem 1.2rem 0 1.2rem;
            background: #fff;
        }

        .modal-custom .modal-body {
            padding: 0.8rem 1.2rem 1.2rem 1.2rem;
            text-align: center;
            background: #fff;
        }

        .modal-custom .modal-footer {
            border-top: none;
            justify-content: center;
            gap: 10px;
            padding: 0 1.2rem 1.2rem 1.2rem;
            background: #fff;
        }

        .modal-icon {
            width: 55px;
            height: 55px;
            background: #fee2e2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.8rem auto;
        }

        .modal-icon i {
            font-size: 2rem;
            color: #dc3545;
        }

        .modal-custom h5 {
            font-weight: 700;
            font-size: 1.2rem;
            color: #1e2f3a;
            margin-bottom: 0.3rem;
        }

        .modal-custom p {
            color: #6c7e8f;
            font-size: 0.8rem;
            margin-bottom: 0.3rem;
        }

        .modal-custom .warning-text {
            color: #dc3545;
            font-size: 0.75rem;
            font-weight: 500;
            margin-top: 0.3rem;
        }

        .btn-cancel-modal {
            background: #e9ecef;
            border: none;
            border-radius: 30px;
            padding: 6px 20px;
            font-weight: 600;
            font-size: 0.75rem;
            color: #495057;
            transition: all 0.2s;
        }

        .btn-cancel-modal:hover {
            background: #dee2e6;
            transform: translateY(-1px);
        }

        .btn-confirm {
            background: #dc3545;
            border: none;
            border-radius: 30px;
            padding: 6px 20px;
            font-weight: 600;
            font-size: 0.75rem;
            color: white;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }

        .btn-confirm:hover {
            background: #c82333;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(220, 53, 69, 0.4);
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -240px;
            }

            #sidebar.active {
                margin-left: 0;
            }

            #content {
                margin-left: 0;
                width: 100%;
            }

            .form-row-custom {
                grid-template-columns: 1fr;
                gap: 0.8rem;
            }

            .btn-sm-action {
                padding: 2px 6px;
                font-size: 0.55rem;
            }

            .back-button-container {
                text-align: center;
            }

            .form-card .card-body-custom {
                padding: 1rem;
            }

            .info-box {
                flex-direction: column;
                gap: 6px;
            }
        }
    </style>
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="p-3 pt-3">
                <a href="#" class="img logo rounded-circle mb-3" style="background-image: url('{{ asset('images/logo.png') }}');"></a>
                <ul class="list-unstyled components mb-4">
                    <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    @if(auth()->user()->role == 'pemilik')
                    <li><a href="{{ route('pegawai.index') }}"><i class="fas fa-user-shield"></i> Pegawai</a></li>
                    @endif
                    <li><a href="{{ route('pelanggan.index') }}"><i class="fas fa-user-group"></i> Pelanggan</a></li>
                    <li><a href="{{ route('supplier.index') }}"><i class="fas fa-handshake"></i> Supplier</a></li>
                    <li><a href="{{ route('bahanbaku.index') }}"><i class="fas fa-box-open"></i> Bahan Baku</a></li>
                    <li class="active"><a href="{{ route('barang.index') }}"><i class="fas fa-boxes"></i> Barang</a></li>
                    <li><a href="{{ route('pembelian.index') }}"><i class="fas fa-cart-plus"></i> Pembelian</a></li>
                    <li><a href="{{ route('penjualan.index') }}"><i class="fas fa-store"></i> Penjualan</a></li>
                    <li><a href="#" onclick="showLogoutModal(event)"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </nav>

        <div id="content" class="p-3 p-md-4">
            <nav class="navbar navbar-expand-lg navbar-light navbar-custom mb-3">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-toggle">
                        <i class="fa fa-bars"></i> <span class="ml-1">Menu</span>
                    </button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                            @if(auth()->user()->role == 'pemilik')
                            <li class="nav-item"><a class="nav-link" href="{{ route('pegawai.index') }}">Pegawai</a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link" href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('supplier.index') }}">Supplier</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('bahanbaku.index') }}">Bahan Baku</a></li>
                            <li class="nav-item active"><a class="nav-link" href="{{ route('barang.index') }}">Barang</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('pembelian.index') }}">Pembelian</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('penjualan.index') }}">Penjualan</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                                    <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> My Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" onclick="showLogoutModal(event)"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="page-header">
                <h2>Detail Barang</h2>
            </div>

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px; padding: 12px 20px;">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <strong>{{ session('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px; padding: 12px 20px;">
                <i class="fas fa-check-circle mr-2"></i>
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            {{-- Info Barang Card --}}
            <div class="form-card">
                <div class="card-header-custom">
                    <h3><i class="fas fa-file-alt"></i> Informasi Barang</h3>
                </div>
                <div class="card-body-custom">
                    <div class="info-box">
                        <div class="info-item">
                            <span class="label"><i class="fas fa-hashtag"></i> No Barang:</span>
                            <strong>{{ $barang->no_barang }}</strong>
                        </div>
                        <div class="info-item">
                            <span class="label"><i class="fas fa-tag"></i> Nama Barang:</span>
                            <strong>{{ $barang->nama_barang }}</strong>
                        </div>
                        <div class="info-item">
                            <span class="label"><i class="fas fa-ruler"></i> Ukuran:</span>
                            <strong>{{ $barang->ukuran ?? '-' }}</strong>
                        </div>
                        <div class="info-item">
                            <span class="label"><i class="fas fa-cubes"></i> Stok:</span>
                            <strong>{{ number_format($barang->stok_barang, 0, ',', '.') }}</strong>
                        </div>
                        <div class="info-item">
                            <span class="label"><i class="fas fa-money-bill-wave"></i> Harga Jual:</span>
                            <strong style="color:#ff8c1a;">Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Detail BOM --}}
            <div class="card-table">
                <div class="card-header-custom">
                    <h5><i class="fas fa-boxes mr-2" style="color:#ff8c1a;"></i> Daftar Detail BOM</h5>
                    <div style="display: flex; gap: 12px; align-items: center;">
                        <a href="{{ route('detail-barang.cetak', $barang->no_barang) }}" class="btn-print" target="_blank">
                            <i class="fas fa-print"></i> Cetak BOM
                        </a>
                        <a href="{{ route('detail-barang.create') }}?no_barang={{ $barang->no_barang }}" class="btn-add">
                            <i class="fas fa-plus-circle"></i> Tambah Detail
                        </a>
                    </div>
                </div>

                <div class="data-table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No Bahan</th>
                                <th>Nama Bahan</th>
                                <th>Satuan</th>
                                <th>Qty Pakai</th>
                                <th>Harga Beli</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($detailBarang as $d)
                            <tr>
                                <td>{{ $d->no_bahan }}</td>
                                <td style="text-align:left;">{{ $d->bahanBaku->nama_bahan ?? '-' }}</td>
                                <td>{{ $d->bahanBaku->satuan ?? '-' }}</td>
                                <td>{{ number_format($d->qty_pakai, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($d->bahanBaku->harga_beli ?? 0, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($d->subtotal_bom, 0, ',', '.') }}</td>
                                <td style="white-space:nowrap;">
                                    <a class="btn btn-sm-action btn-edit" href="{{ route('detail-barang.edit', $barang->no_barang . '-' . $d->no_bahan) }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Ubah
                                    </a>
                                    <button class="btn btn-sm-action btn-delete" onclick="showDeleteModal('{{ $barang->no_barang . '-' . $d->no_bahan }}')">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="text-align:center; padding:20px;">
                                    <i class="fas fa-info-circle"></i> Belum ada bahan baku untuk barang ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if($detailBarang->count() > 0)
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="5" class="total-label">
                                    <strong>
                                        <i class="fas fa-calculator" style="color:#ff8c1a;"></i>
                                        <span style="margin-left: 5px;">TOTAL BIAYA BAHAN BAKU (HPP)</span>
                                    </strong>
                                </td>
                                <td class="total-amount">
                                    <strong>Rp {{ number_format($totalHpp, 0, ',', '.') }}</strong>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>

            {{-- Tombol Kembali --}}
            <div class="back-button-container">
                <a href="{{ route('barang.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade modal-custom" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-icon"><i class="fas fa-trash-alt"></i></div>
                    <h5>Delete Data</h5>
                    <p>Are you sure you want to delete this data?</p>
                    <p>This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">Batal</button>
                    <form id="deleteForm" action="" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-confirm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Logout Modal --}}
    <div class="modal fade modal-custom" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-icon"><i class="fas fa-sign-out-alt"></i></div>
                    <h5>Logout Account?</h5>
                    <p>Yakin mau logout dari akun ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">Batal</button>
                    <a href="{{ route('logout') }}" class="btn-confirm" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function(e) {
                e.preventDefault();
                $('#sidebar').toggleClass('active');
            });

            function adjustContent() {
                if ($('#sidebar').hasClass('active')) {
                    $('#content').css({
                        'margin-left': '0',
                        'width': '100%'
                    });
                } else {
                    if ($(window).width() > 768) {
                        $('#content').css({
                            'margin-left': '240px',
                            'width': 'calc(100% - 240px)'
                        });
                    } else {
                        $('#content').css({
                            'margin-left': '0',
                            'width': '100%'
                        });
                    }
                }
            }

            $('#sidebarCollapse').on('click', function() {
                setTimeout(adjustContent, 100);
            });
            $(window).on('resize', adjustContent);
            adjustContent();
        });

        function showDeleteModal(id) {
            var form = document.getElementById('deleteForm');
            form.action = "{{ url('detail-barang') }}/" + id;
            $('#deleteModal').modal('show');
        }

        function showLogoutModal(event) {
            event.preventDefault();
            $('#logoutModal').modal('show');
        }
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Dashboard - Gallery Namia</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
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
            border-radius: 0 24px 24px 0;
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
        }

        #sidebar.active ~ #content {
            margin-left: 0;
            width: 100%;
        }

        .navbar-custom {
            background: white;
            border-radius: 20px;
            padding: 0.4rem 1.2rem;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.03);
            margin-bottom: 1.5rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .btn-toggle {
            background: #1f5e7e;
            border: none;
            color: white;
            border-radius: 30px;
            padding: 5px 14px;
            font-weight: 500;
            font-size: 0.8rem;
            cursor: pointer;
        }

        .btn-toggle:hover {
            background: #0f4a64;
        }

        .dashboard-header {
            margin-bottom: 1.5rem;
        }

        .dashboard-header h2 {
            font-weight: 700;
            font-size: 1.5rem;
            color: #1e2f3a;
            position: relative;
            display: inline-block;
        }

        .dashboard-header h2:after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 45px;
            height: 3px;
            background: linear-gradient(90deg, #ff8c1a, #ffb347);
            border-radius: 3px;
        }

        .welcome-card {
            background: linear-gradient(135deg, #0f2b3d 0%, #1a3f55 100%);
            border-radius: 20px;
            padding: 1.2rem 1.5rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .welcome-card h4 {
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }

        .welcome-card p {
            font-size: 0.75rem;
            opacity: 0.8;
            margin-bottom: 0;
        }

        .stat-card {
            border: none;
            border-radius: 20px;
            background: white;
            transition: all 0.25s ease-in-out;
            box-shadow: 0 10px 22px -8px rgba(0, 32, 64, 0.08);
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.15);
        }

        .card-body-stats {
            padding: 1rem 1.2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stats-info h5 {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            color: #6c7e8f;
            margin-bottom: 0.3rem;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 800;
            color: #1c3f4f;
            line-height: 1.2;
        }

        .stats-icon {
            font-size: 2.5rem;
            opacity: 0.85;
            color: #ff9142;
        }

        .chart-card {
            border: none;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 22px -8px rgba(0, 32, 64, 0.08);
            overflow: hidden;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .chart-card .card-header-custom {
            background: transparent;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #eef2f7;
        }

        .chart-card .card-header-custom h5 {
            font-weight: 600;
            color: #1c3f4f;
            margin: 0;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chart-card .card-header-custom h5 i {
            color: #ff8c1a;
        }

        .chart-card .card-body-custom {
            padding: 1.2rem;
        }

        .chart-container {
            position: relative;
            height: 350px;
            width: 100%;
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -240px;
            }

            #sidebar.active {
                margin-left: 0;
                width: 100%;
            }

            #content {
                margin-left: 0;
                width: 100%;
            }

            .stats-number {
                font-size: 1.5rem;
            }

            .stats-icon {
                font-size: 2rem;
            }

            .chart-container {
                height: 250px;
            }
        }

        .row-cards {
            animation: fadeUp 0.5s ease-out;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-custom .modal-content {
            border-radius: 20px;
            border: none;
        }

        .modal-custom .modal-header {
            border-bottom: none;
            padding: 1rem 1.2rem 0 1.2rem;
        }

        .modal-custom .modal-body {
            padding: 0.8rem 1.2rem 1.2rem;
            text-align: center;
        }

        .modal-custom .modal-footer {
            border-top: none;
            justify-content: center;
            gap: 10px;
            padding: 0 1.2rem 1.2rem;
        }

        .modal-icon {
            width: 55px;
            height: 55px;
            background: #fee2e2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.8rem;
        }

        .modal-icon i {
            font-size: 2rem;
            color: #dc3545;
        }

        .btn-cancel {
            background: #e9ecef;
            border: none;
            border-radius: 30px;
            padding: 6px 20px;
            font-weight: 600;
            font-size: 0.75rem;
            color: #495057;
        }

        .btn-confirm {
            background: #dc3545;
            border: none;
            border-radius: 30px;
            padding: 6px 20px;
            font-weight: 600;
            font-size: 0.75rem;
            color: white;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
            text-decoration: none;
        }

        .btn-confirm:hover {
            background: #c82333;
            color: white;
        }

        .dropdown-menu {
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
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
    </style>
</head>
<body>
<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="p-3 pt-3">
            <a href="#" class="img logo rounded-circle mb-3" style="background-image: url('{{ asset('images/logo.png') }}');"></a>
            <ul class="list-unstyled components mb-4">
                <li class="active"><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>

                 {{-- 1. Pegawai (khusus pemilik) --}}
                    @if(auth()->user()->role == 'pemilik')
                        <li><a href="{{ route('pegawai.index') }}"><i class="fas fa-user-shield"></i> Pegawai</a></li>
                    @endif

                    {{-- 2. Pelanggan (semua role) --}}
                    <li><a href="{{ route('pelanggan.index') }}"><i class="fas fa-user-group"></i> Pelanggan</a></li>

                    {{-- 3. Supplier (khusus pemilik) --}}
                    @if(auth()->user()->role == 'pemilik')
                        <li><a href="{{ route('supplier.index') }}"><i class="fas fa-handshake"></i> Supplier</a></li>
                    @endif

                    {{-- 4. Bahan Baku (khusus pemilik) --}}
                    @if(auth()->user()->role == 'pemilik')
                        <li><a href="{{ route('bahanbaku.index') }}"><i class="fas fa-box-open"></i> Bahan Baku</a></li>
                    @endif

                    {{-- 5. Barang (khusus pemilik) --}}
                    @if(auth()->user()->role == 'pemilik')
                        <li><a href="{{ route('barang.index') }}"><i class="fas fa-boxes"></i> Barang</a></li>
                    @endif

                    {{-- 6. Pembelian (khusus pemilik) --}}
                    @if(auth()->user()->role == 'pemilik')
                        <li><a href="{{ route('pembelian.index') }}"><i class="fas fa-cart-plus"></i> Pembelian</a></li>
                    @endif

                    {{-- 7. Penjualan (semua role) --}}
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
                            <li class="nav-item active"><a class="nav-link" href="#">Dashboard</a></li>

                            {{-- Pegawai (khusus pemilik) --}}
                            @if(auth()->user()->role == 'pemilik')
                                <li class="nav-item"><a class="nav-link" href="{{ route('pegawai.index') }}">Pegawai</a></li>
                            @endif

                            {{-- Pelanggan (semua role) --}}
                            <li class="nav-item"><a class="nav-link" href="{{ route('pelanggan.index') }}">Pelanggan</a></li>

                            {{-- Supplier (khusus pemilik) --}}
                            @if(auth()->user()->role == 'pemilik')
                                <li class="nav-item"><a class="nav-link" href="{{ route('supplier.index') }}">Supplier</a></li>
                            @endif

                            {{-- Bahan Baku (khusus pemilik) --}}
                            @if(auth()->user()->role == 'pemilik')
                                <li class="nav-item"><a class="nav-link" href="{{ route('bahanbaku.index') }}">Bahan Baku</a></li>
                            @endif

                            {{-- Barang (khusus pemilik) --}}
                            @if(auth()->user()->role == 'pemilik')
                                <li class="nav-item"><a class="nav-link" href="{{ route('barang.index') }}">Barang</a></li>
                            @endif

                            {{-- Pembelian (khusus pemilik) --}}
                            @if(auth()->user()->role == 'pemilik')
                                <li class="nav-item"><a class="nav-link" href="{{ route('pembelian.index') }}">Pembelian</a></li>
                            @endif

                            {{-- Penjualan (semua role) --}}
                            <li class="nav-item"><a class="nav-link" href="{{ route('penjualan.index') }}">Penjualan</a></li>

                            {{-- Profile Dropdown --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user"></i> My Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" onclick="showLogoutModal(event)">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                </div>
            </div>
        </nav>

        <div class="welcome-card">
            <div class="d-flex align-items-center">
                <div class="mr-3">
                    <i class="fas {{ auth()->user()->role == 'admin' ? 'fa-user-shield' : 'fa-crown' }}" style="font-size: 2rem; opacity: 0.9;"></i>
                </div>
                <div>
                    <h4 class="mb-0">Selamat Datang, {{ auth()->user()->name }}!</h4>
                    <p class="mb-0">Anda login sebagai <strong>{{ ucfirst(auth()->user()->role) }}</strong> </p>
                </div>
            </div>
        </div>

        <div class="dashboard-header d-flex justify-content-between align-items-end flex-wrap">
            <div><h2>Dashboard</h2></div>
            <div><span class="badge badge-pill px-2 py-1" style="background:#e9f0f5; color:#2c6b8f; font-size:0.65rem;"><i class="far fa-calendar-alt mr-1"></i> Update realtime</span></div>
        </div>

        <div class="row row-cards mb-3">
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="stat-card">
                    <div class="card-body-stats">
                        <div class="stats-info">
                            <h5>Total Penjualan</h5>
                            <div class="stats-number">{{ $totalPenjualan }}</div>
                        </div>
                        <div class="stats-icon"><i class="fas fa-store"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="stat-card">
                    <div class="card-body-stats">
                        <div class="stats-info">
                            <h5>Total Pegawai</h5>
                            <div class="stats-number">{{ $totalPegawai }}</div>
                        </div>
                        <div class="stats-icon"><i class="fas fa-user-shield"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="stat-card">
                    <div class="card-body-stats">
                        <div class="stats-info">
                            <h5>Total Pelanggan</h5>
                            <div class="stats-number">{{ $totalPelanggan }}</div>
                        </div>
                        <div class="stats-icon"><i class="fas fa-user-group"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="stat-card">
                    <div class="card-body-stats">
                        <div class="stats-info">
                            <h5>Total Pembelian</h5>
                            <div class="stats-number">{{ $totalPembelian }}</div>
                        </div>
                        <div class="stats-icon"><i class="fas fa-cart-plus"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="stat-card">
                    <div class="card-body-stats">
                        <div class="stats-info">
                            <h5>Total Supplier</h5>
                            <div class="stats-number">{{ $totalSupplier }}</div>
                        </div>
                        <div class="stats-icon"><i class="fas fa-handshake"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="stat-card">
                    <div class="card-body-stats">
                        <div class="stats-info">
                            <h5>Total Barang</h5>
                            <div class="stats-number">{{ $totalBarang }}</div>
                        </div>
                        <div class="stats-icon"><i class="fas fa-boxes"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="stat-card">
                    <div class="card-body-stats">
                        <div class="stats-info">
                            <h5>Total Bahan Baku</h5>
                            <div class="stats-number">{{ $totalBahanBaku }}</div>
                        </div>
                        <div class="stats-icon"><i class="fas fa-box-open"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="chart-card">
            <div class="card-header-custom">
                <h5><i class="fas fa-chart-line"></i> Grafik Penjualan Per Bulan</h5>
            </div>
            <div class="card-body-custom">
                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>

        <div class="chart-card">
            <div class="card-header-custom">
                <h5><i class="fas fa-chart-bar"></i> Jumlah Transaksi Per Bulan</h5>
            </div>
            <div class="card-body-custom">
                <div class="chart-container">
                    <canvas id="transactionsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Logout Modal -->
        <div class="modal fade modal-custom" id="logoutModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-icon"><i class="fas fa-sign-out-alt"></i></div>
                        <h5>Logout Account?</h5>
                        <p>Are you sure you want to logout your account?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" data-dismiss="modal">Cancel</button>
                        <a href="{{ route('logout') }}" class="btn-confirm" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    </div>
                </div>
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
                $('#content').css({ 'margin-left': '0', 'width': '100%' });
            } else {
                if ($(window).width() > 768) {
                    $('#content').css({ 'margin-left': '240px', 'width': 'calc(100% - 240px)' });
                } else {
                    $('#content').css({ 'margin-left': '0', 'width': '100%' });
                }
            }
        }
        $('#sidebarCollapse').on('click', function() { setTimeout(adjustContent, 100); });
        $(window).on('resize', adjustContent);
        adjustContent();

        const bulanLabels = @json($bulanLabels);
        const totalPenjualan = @json($totalValues);
        const jumlahTransaksi = @json($jumlahValues);

        new Chart(document.getElementById('salesChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: bulanLabels,
                datasets: [{
                    label: 'Total Penjualan (Rp)',
                    data: totalPenjualan,
                    borderColor: '#ff8c1a',
                    backgroundColor: 'rgba(255, 140, 26, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#ff8c1a',
                    pointBorderColor: '#fff',
                    pointRadius: 5,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                return 'Rp ' + ctx.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById('transactionsChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: bulanLabels,
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: jumlahTransaksi,
                    backgroundColor: 'rgba(255, 140, 26, 0.7)',
                    borderColor: '#ff8c1a',
                    borderRadius: 8,
                    barPercentage: 0.65
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                return ctx.raw + ' transaksi';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    });

    function showLogoutModal(event) {
        event.preventDefault();
        $('#logoutModal').modal('show');
    }
</script>
</body>
</html>
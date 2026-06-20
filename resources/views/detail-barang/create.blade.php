<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Tambah Detail Barang - Gallery Namia</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #f0f2f8; overflow-x: hidden; font-size: 13px; }
        .wrapper { display: flex; width: 100%; align-items: stretch; }
        #sidebar {
            position: fixed; top: 0; left: 0; height: 100vh; width: 240px; min-width: 240px; max-width: 240px;
            background: linear-gradient(145deg, #0f2b3d 0%, #1a3f55 100%); color: #fff; transition: all 0.3s ease;
            box-shadow: 8px 0 25px rgba(0, 0, 0, 0.08); z-index: 1000; border-radius: 0 24px 24px 0; overflow-y: auto;
        }
        #sidebar.active { margin-left: -240px; }
        #sidebar .logo {
            display: flex; align-items: center; justify-content: center; width: 70px; height: 70px;
            margin: 0 auto 15px auto; background-size: cover; background-position: center; border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.35); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        #sidebar ul.components { padding: 0.8rem 0; }
        #sidebar ul li { margin: 0.2rem 0.6rem; border-radius: 12px; transition: all 0.2s; }
        #sidebar ul li a {
            padding: 8px 16px; font-size: 0.85rem; font-weight: 500; display: flex; align-items: center;
            gap: 10px; color: #eef4ff; border-radius: 12px; transition: 0.2s; text-decoration: none;
        }
        #sidebar ul li a i { width: 20px; font-size: 1rem; text-align: center; }
        #sidebar ul li.active, #sidebar ul li:hover { background: rgba(255, 255, 255, 0.12); }
        #sidebar ul li.active a { color: white; font-weight: 600; background: linear-gradient(95deg, #ffb347, #ff8c1a); }
        #content {
            width: 100%; background: #f4f7fc; transition: all 0.3s; min-height: 100vh;
            margin-left: 240px; width: calc(100% - 240px);
        }
        #sidebar.active~#content { margin-left: 0; width: 100%; }
        .navbar-custom {
            background: white; border-radius: 20px; padding: 0.4rem 1.2rem;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.03); margin-bottom: 1.5rem; position: sticky; top: 0; z-index: 999;
        }
        .btn-toggle { background: #1f5e7e; border: none; color: white; border-radius: 30px; padding: 5px 14px; font-weight: 500; font-size: 0.8rem; cursor: pointer; }
        .btn-toggle:hover { background: #0f4a64; }
        .form-card {
            border: none; border-radius: 20px; background: white;
            box-shadow: 0 12px 28px -8px rgba(0, 32, 64, 0.08); overflow: hidden; margin-top: 0.8rem; margin-bottom: 1.5rem;
        }
        .form-card .card-header-custom {
            background: transparent; padding: 0.8rem 1.2rem; border-bottom: 1px solid #eef2f7;
        }
        .form-card .card-header-custom h3 {
            font-weight: 700; color: #1c3f4f; margin: 0; font-size: 1rem; display: flex; align-items: center; gap: 10px;
        }
        .form-card .card-header-custom h3 i { color: #ff8c1a; font-size: 1.2rem; }
        .form-card .card-body-custom { padding: 1.2rem; max-height: 70vh; overflow-y: auto; }
        .form-group-custom { margin-bottom: 1rem; }
        .form-group-custom label {
            font-weight: 600; color: #2c5a6e; margin-bottom: 0.3rem; font-size: 0.7rem; letter-spacing: 0.3px; display: block; text-transform: uppercase;
        }
        .form-group-custom label i { margin-right: 6px; color: #ff8c1a; width: 20px; }
        .form-control-custom {
            width: 100%; padding: 8px 14px; font-size: 0.75rem; font-weight: 500; border: 2px solid #e2e8f0;
            border-radius: 14px; transition: all 0.2s; background: #fefefe; font-family: 'Poppins', sans-serif;
        }
        .form-control-custom:focus { outline: none; border-color: #ff8c1a; box-shadow: 0 0 0 3px rgba(255, 140, 26, 0.1); }
        .form-control-custom[readonly] { background: #f5f7fb; color: #6c7e8f; border-color: #e9ecef; }
        .btn-action {
            border-radius: 30px; padding: 6px 20px; font-weight: 600; font-size: 0.7rem; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 8px; text-decoration: none; border: none;
        }
        .btn-save { background: linear-gradient(95deg, #ffb347, #ff8c1a); color: white; box-shadow: 0 4px 12px rgba(255, 140, 26, 0.3); }
        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(255, 140, 26, 0.4); color: white; }
        .btn-back { background: #dc3545; color: white; }
        .btn-back:hover { background: #c82333; transform: translateY(-2px); color: white; }
        .info-badge {
            background: #eef2fa; padding: 6px 12px; border-radius: 20px; display: inline-flex; align-items: center;
            gap: 6px; color: #1f5e7e; font-size: 0.65rem; margin-top: 0.8rem; margin-bottom: 0.8rem;
        }
        .navbar-nav .nav-link {
            font-weight: 500; color: #3a5b6e; margin: 0 4px; border-radius: 30px; padding: 4px 12px; font-size: 0.7rem;
        }
        .navbar-nav .nav-link:hover { background: #eef2f7; color: #ff7a2f; }
        .navbar-nav .nav-link.active { background: #ff8c1a20; color: #ff7a2f; font-weight: 600; }
        .dropdown-menu { border-radius: 12px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); border: none; padding: 8px 0; }
        .dropdown-item { font-size: 13px; padding: 8px 20px; }
        .dropdown-item i { width: 20px; margin-right: 8px; }
        .dropdown-item:hover { background: #f8f9fa; }
        .modal-custom .modal-content { border-radius: 20px; border: none; box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.2); overflow: hidden; }
        .modal-custom .modal-header { border-bottom: none; padding: 1rem 1.2rem 0 1.2rem; background: #fff; }
        .modal-custom .modal-body { padding: 0.8rem 1.2rem 1.2rem 1.2rem; text-align: center; }
        .modal-custom .modal-footer { border-top: none; justify-content: center; gap: 10px; padding: 0 1.2rem 1.2rem 1.2rem; background: #fff; }
        .modal-icon { width: 55px; height: 55px; background: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.8rem auto; }
        .modal-icon i { font-size: 2rem; color: #dc3545; }
        .modal-custom h5 { font-weight: 700; font-size: 1.2rem; color: #1e2f3a; margin-bottom: 0.3rem; }
        .modal-custom p { color: #6c7e8f; font-size: 0.8rem; margin-bottom: 0.3rem; }
        .btn-cancel-modal { background: #e9ecef; border: none; border-radius: 30px; padding: 6px 20px; font-weight: 600; font-size: 0.75rem; color: #495057; }
        .btn-cancel-modal:hover { background: #dee2e6; transform: translateY(-1px); }
        .btn-confirm { background: #dc3545; border: none; border-radius: 30px; padding: 6px 20px; font-weight: 600; font-size: 0.75rem; color: white; box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3); }
        .btn-confirm:hover { background: #c82333; transform: translateY(-1px); box-shadow: 0 6px 14px rgba(220, 53, 69, 0.4); }
        .select2-container--default .select2-selection--single {
            border: 2px solid #e2e8f0; border-radius: 14px; height: 38px; padding: 4px 8px; font-size: 0.8rem; font-family: 'Poppins', sans-serif;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px; color: #2c3e4e;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
        .select2-dropdown {
            border-radius: 14px; border-color: #e2e8f0; font-size: 0.8rem;
        }
        @media (max-width: 768px) {
            #sidebar { margin-left: -240px; }
            #sidebar.active { margin-left: 0; width: 100%; }
            #content { margin-left: 0; width: 100%; }
            .form-card .card-body-custom { padding: 1rem; max-height: 65vh; }
            .btn-action { padding: 5px 16px; }
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
                <li><a href="{{ route('pegawai.index') }}"><i class="fas fa-user-shield"></i> Pegawai</a></li>
                <li><a href="{{ route('pelanggan.index') }}"><i class="fas fa-user-group"></i> Pelanggan</a></li>
                <li><a href="{{ route('supplier.index') }}"><i class="fas fa-handshake"></i> Supplier</a></li>
                <li><a href="{{ route('bahanbaku.index') }}"><i class="fas fa-box-open"></i> Bahan Baku</a></li>
                <li><a href="{{ route('barang.index') }}"><i class="fas fa-boxes"></i> Barang</a></li>
                <li class="active"><a href="{{ route('detail-barang.index') }}"><i class="fas fa-cubes"></i> Detail Barang</a></li>
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
                        <li class="nav-item"><a class="nav-link" href="{{ route('pegawai.index') }}">Pegawai</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('supplier.index') }}">Supplier</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('bahanbaku.index') }}">Bahan Baku</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('barang.index') }}">Barang</a></li>
                        <li class="nav-item active"><a class="nav-link" href="{{ route('detail-barang.index') }}">Detail Barang</a></li>
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

        <div class="form-card">
            <div class="card-header-custom">
                <h3><i class="fas fa-plus-circle"></i> Tambah Detail Barang</h3>
            </div>
            <div class="card-body-custom">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('detail-barang.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="no_barang" value="{{ $barang->no_barang }}">

                    <div class="form-group-custom">
                        <label><i class="fas fa-hashtag"></i> NO BARANG</label>
                        <input type="text" class="form-control-custom" value="{{ $barang->no_barang }} - {{ $barang->nama_barang }}" readonly>
                    </div>

                    <div class="form-group-custom">
                        <label><i class="fas fa-flask"></i> BAHAN BAKU</label>
                        <select class="form-control-custom" name="no_bahan" id="bahanBaku" required>
                            <option value="">--- Pilih Bahan Baku ---</option>
                            @foreach($bahanBaku as $b)
                                <option value="{{ $b->no_bahan }}" data-stok="{{ $b->stok_bahan }}" data-harga="{{ $b->harga_beli }}" data-satuan="{{ $b->satuan }}">
                                    {{ $b->no_bahan }} - {{ $b->nama_bahan }} (Stok: {{ number_format($b->stok_bahan, 0, ',', '.') }} {{ $b->satuan }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group-custom">
                        <label><i class="fas fa-calculator"></i> QTY PAKAI</label>
                        <input type="number" name="qty_pakai" id="qtyPakai" class="form-control-custom" placeholder="Masukkan jumlah pemakaian" required min="1">
                        <small class="form-text text-muted" id="stokInfo"></small>
                    </div>

                    <div class="form-group-custom">
                        <label><i class="fas fa-money-bill-wave"></i> HARGA BELI</label>
                        <input type="text" id="hargaBeli" class="form-control-custom" readonly placeholder="Akan terisi otomatis">
                    </div>

                    <div class="form-group-custom">
                        <label><i class="fas fa-chart-line"></i> SUBTOTAL BOM</label>
                        <input type="text" id="subtotalBom" class="form-control-custom" readonly placeholder="Akan terisi otomatis">
                    </div>

                    <div class="info-badge">
                        <i class="fas fa-info-circle"></i> Subtotal BOM akan dihitung otomatis (Qty Pakai × Harga Beli)
                    </div>

                    <div class="mt-3" style="display: flex; gap: 10px; justify-content: flex-end;">
                        <a href="{{ route('detail-barang.show', $barang->no_barang) }}" class="btn btn-action btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-action btn-save">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Logout Modal -->
<div class="modal fade modal-custom" id="logoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span>&times;</span></button></div>
            <div class="modal-body">
                <div class="modal-icon"><i class="fas fa-sign-out-alt"></i></div>
                <h5>Logout Account?</h5>
                <p>Are you sure you want to logout your account?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
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

        // Auto calculate subtotal
        $('#bahanBaku, #qtyPakai').on('change keyup', function() {
            var harga = $('#bahanBaku option:selected').data('harga') || 0;
            var qty = parseInt($('#qtyPakai').val()) || 0;
            var stok = $('#bahanBaku option:selected').data('stok') || 0;
            var satuan = $('#bahanBaku option:selected').data('satuan') || '';

            $('#hargaBeli').val('Rp ' + parseInt(harga).toLocaleString('id-ID'));

            if (qty > 0 && harga > 0) {
                var subtotal = qty * harga;
                $('#subtotalBom').val('Rp ' + subtotal.toLocaleString('id-ID'));
            } else {
                $('#subtotalBom').val('');
            }

            // Stok info
            if (stok > 0) {
                $('#stokInfo').html('<i class="fas fa-database"></i> Stok tersedia: ' + parseInt(stok).toLocaleString('id-ID') + ' ' + satuan);
                $('#stokInfo').css('color', qty > stok ? '#dc3545' : '#28a745');
            } else {
                $('#stokInfo').html('');
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
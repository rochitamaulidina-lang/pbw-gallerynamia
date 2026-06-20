<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Daftar Bahan Baku - Gallery Namia</title>
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
        .card-table {
            border: none; border-radius: 20px; background: white;
            box-shadow: 0 12px 28px -8px rgba(0, 32, 64, 0.08); overflow: hidden; margin-top: 0.8rem;
        }
        .card-table .card-header-custom {
            background: transparent; padding: 0.8rem 1.2rem; border-bottom: 1px solid #eef2f7;
            display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.8rem;
        }
        .card-table .card-header-custom h5 {
            font-weight: 600; color: #1c3f4f; margin: 0; font-size: 1rem;
        }
        .btn-warning-custom {
            background: linear-gradient(95deg, #ffb347, #ff8c1a); border: none; color: white; border-radius: 30px;
            padding: 5px 18px; font-weight: 500; font-size: 0.75rem; transition: all 0.2s;
            box-shadow: 0 4px 10px rgba(255, 140, 26, 0.25); text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-warning-custom:hover {
            background: linear-gradient(95deg, #ffa233, #ff7a0f); transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(255, 140, 26, 0.35); color: white; text-decoration: none;
        }
        .table-wrapper { overflow-x: auto; overflow-y: visible; margin: 0 0.8rem 0.8rem 0.8rem; }
        .data-table { width: 100%; min-width: 700px; border-collapse: collapse; }
        .data-table thead th {
            background: #f8fafd; color: #1e4a62; font-weight: 600; font-size: 0.65rem; text-transform: uppercase;
            padding: 10px 8px; border-bottom: 2px solid #e2e8f0; text-align: center; border-right: 1px solid #e9ecef; white-space: nowrap;
        }
        .data-table thead th a {
            color: #1e4a62; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; font-size: 0.65rem;
        }
        .data-table thead th a:hover { color: #ff8c1a; }
        .data-table thead th:last-child { border-right: none; }
        .sort-icon { font-size: 0.7rem; display: inline-block; }
        .data-table tbody td {
            padding: 8px 8px; vertical-align: middle; color: #2c3e4e; border-bottom: 1px solid #ecf3f8;
            text-align: center; border-right: 1px solid #f0f2f5; font-size: 0.7rem; white-space: nowrap;
        }
        .data-table tbody td:last-child { border-right: none; }
        .data-table tbody tr:hover { background-color: #fef9ef; }
        .btn-sm-action {
            border-radius: 30px; padding: 3px 8px; font-size: 0.6rem; font-weight: 500; margin: 0 2px;
            transition: all 0.2s; display: inline-flex; align-items: center; gap: 4px; text-decoration: none; border: none;
        }
        .btn-edit { background: #2c7da0; color: white; }
        .btn-edit:hover { background: #1f5e7e; transform: translateY(-1px); color: white; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-delete:hover { background: #c82333; transform: translateY(-1px); color: white; }
        .navbar-nav .nav-link {
            font-weight: 500; color: #3a5b6e; margin: 0 4px; border-radius: 30px; padding: 4px 12px; font-size: 0.7rem;
        }
        .navbar-nav .nav-link:hover { background: #eef2f7; color: #ff7a2f; }
        .navbar-nav .nav-link.active { background: #ff8c1a20; color: #ff7a2f; }
        .pagination {
            padding: 0.6rem 1.2rem; display: flex; justify-content: flex-end; align-items: center; gap: 0.8rem; border-top: 1px solid #eef2f7;
        }
        .pagination .pagination-info { color: #5a6e7c; font-size: 0.7rem; margin-right: auto; }
        .pagination .pagination-buttons { display: flex; gap: 4px; }
        .pagination .pagination-buttons .page-link {
            padding: 4px 10px; border-radius: 20px; border: 1px solid #dce5ec; background: white; cursor: pointer;
            transition: all 0.2s; font-size: 0.7rem; color: #1e4a62; text-decoration: none; display: inline-block;
        }
        .pagination .pagination-buttons .page-link:hover { background: #ff8c1a; color: white; border-color: #ff8c1a; }
        .pagination .pagination-buttons .active .page-link { background: #ff8c1a; color: white; border-color: #ff8c1a; }
        .modal-custom .modal-content { border-radius: 20px; border: none; box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.2); overflow: hidden; }
        .modal-custom .modal-header { border-bottom: none; padding: 1rem 1.2rem 0 1.2rem; background: #fff; }
        .modal-custom .modal-body { padding: 0.8rem 1.2rem 1.2rem 1.2rem; text-align: center; background: #fff; }
        .modal-custom .modal-footer { border-top: none; justify-content: center; gap: 10px; padding: 0 1.2rem 1.2rem 1.2rem; background: #fff; }
        .modal-icon { width: 55px; height: 55px; background: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.8rem auto; }
        .modal-icon i { font-size: 2rem; color: #dc3545; }
        .modal-custom h5 { font-weight: 700; font-size: 1.2rem; color: #1e2f3a; margin-bottom: 0.3rem; }
        .modal-custom p { color: #6c7e8f; font-size: 0.8rem; margin-bottom: 0.3rem; }
        .warning-text { color: #dc3545; font-size: 0.75rem; font-weight: 500; margin-top: 0.3rem; }
        .btn-cancel { background: #e9ecef; border: none; border-radius: 30px; padding: 6px 20px; font-weight: 600; font-size: 0.75rem; color: #495057; transition: all 0.2s; }
        .btn-cancel:hover { background: #dee2e6; transform: translateY(-1px); text-decoration: none; }
        .btn-confirm { background: #dc3545; border: none; border-radius: 30px; padding: 6px 20px; font-weight: 600; font-size: 0.75rem; color: white; transition: all 0.2s; box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3); }
        .btn-confirm:hover { background: #c82333; transform: translateY(-1px); box-shadow: 0 8px 18px rgba(220, 53, 69, 0.4); color: white; text-decoration: none; }
        .dropdown-menu { border-radius: 12px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); border: none; padding: 8px 0; }
        .dropdown-item { font-size: 13px; padding: 8px 20px; }
        .dropdown-item i { width: 20px; margin-right: 8px; }
        .dropdown-item:hover { background: #f8f9fa; }
        @media (max-width: 768px) {
            #sidebar { margin-left: -240px; }
            #sidebar.active { margin-left: 0; width: 100%; }
            #content { margin-left: 0; width: 100%; }
            .card-table .card-header-custom { flex-direction: column; align-items: flex-start; }
            .pagination { flex-direction: column; text-align: center; }
            .pagination .pagination-info { margin-right: 0; }
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
                <li class="active"><a href="{{ route('bahanbaku.index') }}"><i class="fas fa-box-open"></i> Bahan Baku</a></li>
                <li><a href="{{ route('barang.index') }}"><i class="fas fa-boxes"></i> Barang</a></li>
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
                        <li class="nav-item active"><a class="nav-link" href="{{ route('bahanbaku.index') }}">Bahan Baku</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('barang.index') }}">Barang</a></li>
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

        <div class="card-table">
            <div class="card-header-custom">
                <h5><i class="fas fa-box-open mr-2" style="color:#ff8c1a;"></i> Daftar Bahan Baku</h5>
                <a href="{{ route('bahanbaku.create') }}" class="btn btn-warning-custom">
                    <i class="fas fa-plus-circle mr-1"></i> Tambah Bahan Baku
                </a>
            </div>

            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>
                                <a href="{{ route('bahanbaku.index', ['sort' => 'no_bahan', 'order' => ($sortColumn == 'no_bahan' && $sortOrder == 'DESC') ? 'ASC' : 'DESC']) }}">
                                    NO BAHAN
                                    <span class="sort-icon">
                                        @if($sortColumn == 'no_bahan') {!! $sortOrder == 'DESC' ? '↓' : '↑' !!} @else ↕ @endif
                                    </span>
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('bahanbaku.index', ['sort' => 'nama_bahan', 'order' => ($sortColumn == 'nama_bahan' && $sortOrder == 'DESC') ? 'ASC' : 'DESC']) }}">
                                    NAMA BAHAN
                                    <span class="sort-icon">
                                        @if($sortColumn == 'nama_bahan') {!! $sortOrder == 'DESC' ? '↓' : '↑' !!} @else ↕ @endif
                                    </span>
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('bahanbaku.index', ['sort' => 'stok_bahan', 'order' => ($sortColumn == 'stok_bahan' && $sortOrder == 'DESC') ? 'ASC' : 'DESC']) }}">
                                    STOK
                                    <span class="sort-icon">
                                        @if($sortColumn == 'stok_bahan') {!! $sortOrder == 'DESC' ? '↓' : '↑' !!} @else ↕ @endif
                                    </span>
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('bahanbaku.index', ['sort' => 'satuan', 'order' => ($sortColumn == 'satuan' && $sortOrder == 'DESC') ? 'ASC' : 'DESC']) }}">
                                    SATUAN
                                    <span class="sort-icon">
                                        @if($sortColumn == 'satuan') {!! $sortOrder == 'DESC' ? '↓' : '↑' !!} @else ↕ @endif
                                    </span>
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('bahanbaku.index', ['sort' => 'stok_kritis', 'order' => ($sortColumn == 'stok_kritis' && $sortOrder == 'DESC') ? 'ASC' : 'DESC']) }}">
                                    STOK KRITIS
                                    <span class="sort-icon">
                                        @if($sortColumn == 'stok_kritis') {!! $sortOrder == 'DESC' ? '↓' : '↑' !!} @else ↕ @endif
                                    </span>
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('bahanbaku.index', ['sort' => 'harga_beli', 'order' => ($sortColumn == 'harga_beli' && $sortOrder == 'DESC') ? 'ASC' : 'DESC']) }}">
                                    HARGA BELI
                                    <span class="sort-icon">
                                        @if($sortColumn == 'harga_beli') {!! $sortOrder == 'DESC' ? '↓' : '↑' !!} @else ↕ @endif
                                    </span>
                                </a>
                            </th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bahanBaku as $b)
                        <tr>
                            <td>{{ $b->no_bahan }}</td>
                            <td>{{ $b->nama_bahan }}</td>
                            <td>{{ $b->stok_bahan }}</td>
                            <td>{{ $b->satuan }}</td>
                            <td>{{ $b->stok_kritis }}</td>
                            <td>Rp {{ number_format($b->harga_beli, 0, ',', '.') }}</td>
                            <td style="white-space:nowrap;">
                                <a class="btn btn-sm-action btn-edit" href="{{ route('bahanbaku.edit', $b->no_bahan) }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Ubah
                                </a>
                                <button class="btn btn-sm-action btn-delete" onclick="showDeleteModal('{{ $b->no_bahan }}', 'bahanbaku')">
                                    <i class="fa-solid fa-trash-can"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align:center; padding:20px;">Tidak ada data bahan baku</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                <div class="pagination-info">
                    Showing {{ $bahanBaku->firstItem() ?? 0 }} to {{ $bahanBaku->lastItem() ?? 0 }} of {{ $bahanBaku->total() }} entries
                </div>
                <div class="pagination-buttons">
                    @if ($bahanBaku->onFirstPage())
                        <span class="page-link disabled">Previous</span>
                    @else
                        <a class="page-link" href="{{ $bahanBaku->previousPageUrl() }}">Previous</a>
                    @endif

                    @foreach ($bahanBaku->getUrlRange(1, $bahanBaku->lastPage()) as $page => $url)
                        @if ($page == $bahanBaku->currentPage())
                            <span class="active"><span class="page-link">{{ $page }}</span></span>
                        @else
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($bahanBaku->hasMorePages())
                        <a class="page-link" href="{{ $bahanBaku->nextPageUrl() }}">Next</a>
                    @else
                        <span class="page-link disabled">Next</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade modal-custom" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span>&times;</span></button></div>
            <div class="modal-body">
                <div class="modal-icon"><i class="fas fa-trash-alt"></i></div>
                <h5>Delete Data</h5>
                <p>Are you sure you want to delete this data?</p>
                <p class="warning-text">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" action="" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-confirm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Logout Modal --}}
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
                <button type="button" class="btn-cancel" data-dismiss="modal">Cancel</button>
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
    });

    function showDeleteModal(id, module) {
        var form = document.getElementById('deleteForm');
        form.action = "/" + module + "/" + id;
        $('#deleteModal').modal('show');
    }

    function showLogoutModal(event) {
        event.preventDefault();
        $('#logoutModal').modal('show');
    }
</script>
</body>
</html>
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Pegawai;
use App\Models\Pelanggan;
use App\Models\Pembelian;
use App\Models\Supplier;
use App\Models\Barang;
use App\Models\BahanBaku;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik cards
        $totalPenjualan = Penjualan::count();
        $totalPegawai = Pegawai::count();
        $totalPelanggan = Pelanggan::count();
        $totalPembelian = Pembelian::count();
        $totalSupplier = Supplier::count();
        $totalBarang = Barang::count();
        $totalBahanBaku = BahanBaku::count();

        // Data grafik per bulan
        $penjualanPerBulan = Penjualan::select(
                DB::raw('MONTH(tgl_jual) as bulan'),
                DB::raw('YEAR(tgl_jual) as tahun'),
                DB::raw('COUNT(*) as jumlah_transaksi'),
                DB::raw('SUM(total_jual) as total_penjualan')
            )
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $totalValues = array_fill(0, 12, 0);
        $jumlahValues = array_fill(0, 12, 0);

        foreach ($penjualanPerBulan as $data) {
            $index = $data->bulan - 1;
            $totalValues[$index] = (float) $data->total_penjualan;
            $jumlahValues[$index] = (int) $data->jumlah_transaksi;
        }

        return view('dashboard', compact(
            'totalPenjualan', 'totalPegawai', 'totalPelanggan',
            'totalPembelian', 'totalSupplier', 'totalBarang', 'totalBahanBaku',
            'bulanLabels', 'totalValues', 'jumlahValues'
        ));
    }
}
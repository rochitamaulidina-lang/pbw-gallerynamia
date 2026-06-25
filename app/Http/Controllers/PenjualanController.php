<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Pegawai;
use App\Models\Barang;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $sortColumn = $request->get('sort', 'no_jual');
        $sortOrder = $request->get('order', 'DESC');

        $allowedColumns = ['no_jual', 'no_pelanggan', 'no_pegawai', 'tgl_jual', 'total_jual', 'dp', 'sisa_bayar'];
        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'no_jual';
        }
        $sortOrder = ($sortOrder == 'DESC' || $sortOrder == 'ASC') ? $sortOrder : 'DESC';

        $penjualan = Penjualan::with(['pelanggan', 'pegawai'])
            ->orderBy($sortColumn, $sortOrder)
            ->paginate(10);

        return view('penjualan.index', compact('penjualan', 'sortColumn', 'sortOrder'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $pegawai = Pegawai::all();
        return view('penjualan.create', compact('pelanggan', 'pegawai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_jual' => 'required|unique:penjualan,no_jual',
            'no_pelanggan' => 'required|exists:pelanggan,no_pelanggan',
            'no_pegawai' => 'required|exists:pegawai,no_pegawai',
            'tgl_jual' => 'required|date',
        ]);

        $penjualan = Penjualan::create([
            'no_jual' => $request->no_jual,
            'no_pelanggan' => $request->no_pelanggan,
            'no_pegawai' => $request->no_pegawai,
            'tgl_jual' => $request->tgl_jual,
            'dp' => 0,
            'sisa_bayar' => 0,
            'total_jual' => 0,
        ]);

        return redirect()->route('detailpenjualan.create', ['no_jual' => $penjualan->no_jual])
            ->with('success', 'Header penjualan berhasil dibuat! Silakan tambahkan detail barang.');
    }

    public function show($id)
    {
        $penjualan = Penjualan::with(['pelanggan', 'pegawai', 'detailPenjualan.barang'])->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    public function edit($id)
    {
        $penjualan = Penjualan::with(['detailPenjualan'])->findOrFail($id);
        $pelanggan = Pelanggan::all();
        $pegawai = Pegawai::all();
        return view('penjualan.edit', compact('penjualan', 'pelanggan', 'pegawai'));
    }

    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $request->validate([
            'no_pelanggan' => 'required|exists:pelanggan,no_pelanggan',
            'no_pegawai' => 'required|exists:pegawai,no_pegawai',
            'tgl_jual' => 'required|date',
        ]);

        $penjualan->update([
            'no_pelanggan' => $request->no_pelanggan,
            'no_pegawai' => $request->no_pegawai,
            'tgl_jual' => $request->tgl_jual,
        ]);

        return redirect()->route('penjualan.show', $id)
            ->with('success', 'Header penjualan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $detailCount = DetailPenjualan::where('no_jual', $id)->count();

        if ($detailCount > 0) {
            return redirect()->route('penjualan.show', $id)
                ->with('error', "Data penjualan ini masih memiliki $detailCount detail penjualan! Silakan hapus seluruh detail penjualan terlebih dahulu.");
        }

        $penjualan->delete();
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus!');
    }

    public function cetak($id)
    {
        $penjualan = Penjualan::with(['pelanggan', 'pegawai', 'detailPenjualan.barang'])->findOrFail($id);
        return view('penjualan.cetak', compact('penjualan'));
    }

    public function updateDp(Request $request, $no_jual)
    {
        $dp = (int)$request->dp;
        $sisa_bayar = (int)$request->sisa_bayar;

        $penjualan = Penjualan::find($no_jual);
        if (!$penjualan) {
            return response()->json('error', 404);
        }

        $penjualan->dp = $dp;
        $penjualan->sisa_bayar = $sisa_bayar;
        $penjualan->save();

        return response()->json('success');
    }
}

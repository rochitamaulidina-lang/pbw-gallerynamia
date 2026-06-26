<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Supplier;
use App\Models\Pegawai;
use App\Models\BahanBaku;
use App\Models\DetailBeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index(Request $request)
    {
        $sortColumn = $request->get('sort', 'no_beli');
        $sortOrder = $request->get('order', 'DESC');

        $allowedColumns = ['no_beli', 'no_faktur', 'no_supplier', 'no_pegawai', 'tgl_beli', 'total_beli'];
        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'no_beli';
        }
        $sortOrder = ($sortOrder == 'DESC' || $sortOrder == 'ASC') ? $sortOrder : 'DESC';

        $pembelian = Pembelian::with(['supplier', 'pegawai'])
            ->orderBy($sortColumn, $sortOrder)
            ->paginate(10);

        return view('pembelian.index', compact('pembelian', 'sortColumn', 'sortOrder'));
    }

    public function create()
    {
        $supplier = Supplier::all();
        $pegawai = Pegawai::all();
        $bahanBaku = BahanBaku::all();
        return view('pembelian.create', compact('supplier', 'pegawai', 'bahanBaku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_beli' => 'required|unique:pembelian,no_beli',  
            'no_supplier' => 'required|exists:supplier,no_supplier',
            'no_pegawai' => 'nullable|exists:pegawai,no_pegawai',
            'tgl_beli' => 'required|date',
            'no_faktur' => 'nullable|string|max:50',
            'faktur_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $pembelian = Pembelian::create([
                'no_beli' => $request->no_beli,  
                'no_supplier' => $request->no_supplier,
                'no_pegawai' => $request->no_pegawai,
                'tgl_beli' => $request->tgl_beli,
                'no_faktur' => $request->no_faktur,
                'total_beli' => 0,
            ]);

            if ($request->hasFile('faktur_file')) {
                $file = $request->file('faktur_file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/faktur'), $filename);
                $pembelian->update(['faktur_file' => $filename]);
            }
        });

        return redirect()->route('detailbeli.create', $request->no_beli)  // <-- PAKE $request->no_beli!
            ->with('success', 'Pembelian berhasil ditambahkan! Silakan tambahkan detail pembelian.');
    }

    public function show($id)
    {
        $pembelian = Pembelian::with(['supplier', 'pegawai', 'detailBeli.bahanBaku'])->findOrFail($id);
        return view('pembelian.show', compact('pembelian'));
    }

    public function edit($id)
    {
        $pembelian = Pembelian::with('detailBeli')->findOrFail($id);
        $supplier = Supplier::all();
        $pegawai = Pegawai::all();
        $bahanBaku = BahanBaku::all();
        return view('pembelian.edit', compact('pembelian', 'supplier', 'pegawai', 'bahanBaku'));
    }

    public function update(Request $request, $id)
    {
        $pembelian = Pembelian::findOrFail($id);

        $request->validate([
            'no_supplier' => 'required|exists:supplier,no_supplier',
            'no_pegawai' => 'nullable|exists:pegawai,no_pegawai',
            'tgl_beli' => 'required|date',
            'no_faktur' => 'nullable|string|max:50',
            'faktur_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::transaction(function () use ($request, $pembelian) {
            $pembelian->update([
                'no_supplier' => $request->no_supplier,
                'no_pegawai' => $request->no_pegawai,
                'tgl_beli' => $request->tgl_beli,
                'no_faktur' => $request->no_faktur,
            ]);

            // Upload faktur_file baru
            if ($request->hasFile('faktur_file')) {
                // Hapus file lama
                if ($pembelian->faktur_file && file_exists(public_path('uploads/faktur/' . $pembelian->faktur_file))) {
                    unlink(public_path('uploads/faktur/' . $pembelian->faktur_file));
                }
                $file = $request->file('faktur_file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/faktur'), $filename);
                $pembelian->update(['faktur_file' => $filename]);
            }
        });

        return redirect()->route('pembelian.index')
            ->with('success', 'Pembelian berhasil diupdate!');
    }

    public function destroy($no_beli)
    {
        // CEK APAKAH ADA DETAIL BELI
        $detailCount = DetailBeli::where('no_beli', $no_beli)->count();

        if ($detailCount > 0) {
            return redirect()->route('pembelian.show', $no_beli)
                ->with('error', 'Data pembelian ini masih memiliki ' . $detailCount . ' detail pembelian! Silakan hapus seluruh detail pembelian terlebih dahulu.');
        }

        $pembelian = Pembelian::findOrFail($no_beli);

        // Hapus file faktur kalo ada
        if ($pembelian->faktur_file) {
            Storage::delete('public/uploads/faktur/' . $pembelian->faktur_file);
        }

        $pembelian->delete();

        return redirect()->route('pembelian.index')
            ->with('success', 'Pembelian berhasil dihapus!');
    }
}

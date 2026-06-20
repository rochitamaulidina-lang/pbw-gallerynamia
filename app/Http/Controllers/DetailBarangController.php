<?php

namespace App\Http\Controllers;

use App\Models\DetailBarang;
use App\Models\Barang;
use App\Models\BahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailBarangController extends Controller
{
    public function index(Request $request)
    {
        $sortColumn = $request->get('sort', 'no_barang');
        $sortOrder = $request->get('order', 'DESC');
        $allowedColumns = ['no_barang', 'no_bahan', 'qty_pakai', 'subtotal_bom'];
        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'no_barang';
        }
        $sortOrder = ($sortOrder == 'DESC' || $sortOrder == 'ASC') ? $sortOrder : 'DESC';
        
        $query = DetailBarang::with(['barang', 'bahanBaku']);
        if ($request->has('search') && $request->search != '') {
            $query->where('no_barang', $request->search);
        }
        
        $detailBarang = $query->orderBy($sortColumn, $sortOrder)->paginate(10);
        return view('detail-barang.index', compact('detailBarang', 'sortColumn', 'sortOrder'));
    }

    public function create(Request $request)
    {
        $no_barang = $request->get('no_barang');
        $barang = Barang::where('no_barang', $no_barang)->firstOrFail();
        $bahanBaku = BahanBaku::all();
        return view('detail-barang.create', compact('barang', 'bahanBaku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_barang' => 'required|exists:barang,no_barang',
            'no_bahan' => 'required|exists:bahan_baku,no_bahan',
            'qty_pakai' => 'required|integer|min:1',
        ]);

        $no_barang = $request->no_barang;
        $no_bahan = $request->no_bahan;
        $qty_pakai = $request->qty_pakai;

        $exists = DetailBarang::where('no_barang', $no_barang)
            ->where('no_bahan', $no_bahan)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Bahan baku sudah ada di detail barang ini!');
        }

        $bahan = BahanBaku::where('no_bahan', $no_bahan)->first();
        $subtotal_bom = $qty_pakai * $bahan->harga_beli;

        if ($qty_pakai > $bahan->stok_bahan) {
            return back()->with('error', "Stok bahan baku tidak mencukupi! Stok tersedia: {$bahan->stok_bahan}");
        }

        DB::transaction(function () use ($no_barang, $no_bahan, $qty_pakai, $subtotal_bom, $bahan) {
            DetailBarang::create([
                'no_barang' => $no_barang,
                'no_bahan' => $no_bahan,
                'qty_pakai' => $qty_pakai,
                'subtotal_bom' => $subtotal_bom,
            ]);
            
            // KURANGI stok bahan baku
            $bahan->decrement('stok_bahan', $qty_pakai);
        });

        return redirect()->route('detail-barang.show', $no_barang)
            ->with('success', 'Detail barang berhasil ditambahkan!');
    }

    public function show($no_barang)
    {
        $barang = Barang::where('no_barang', $no_barang)->firstOrFail();
        $detailBarang = DetailBarang::with(['bahanBaku'])
            ->where('no_barang', $no_barang)
            ->get();
        $totalHpp = DetailBarang::where('no_barang', $no_barang)->sum('subtotal_bom');
        
        return view('detail-barang.show', compact('barang', 'detailBarang', 'totalHpp'));
    }

    public function edit($id)
    {
        $parts = explode('-', $id);
        $no_barang = $parts[0] ?? null;
        $no_bahan = $parts[1] ?? null;
        
        if (!$no_barang || !$no_bahan) {
            abort(404, 'Data tidak ditemukan');
        }
        
        $barang = Barang::where('no_barang', $no_barang)->firstOrFail();
        $detail = DetailBarang::with('bahanBaku')
            ->where('no_barang', $no_barang)
            ->where('no_bahan', $no_bahan)
            ->firstOrFail();
        
        $bahanBaku = BahanBaku::all(); // ← TAMBAHKAN INI!
        
        return view('detail-barang.edit', compact('barang', 'detail', 'bahanBaku'));
    }

    public function update(Request $request, $id)
    {
        $parts = explode('-', $id);
        $no_barang = $parts[0] ?? null;
        $no_bahan = $parts[1] ?? null;
        
        if (!$no_barang || !$no_bahan) {
            abort(404, 'Data tidak ditemukan');
        }
        
        $request->validate([
            'qty_pakai' => 'required|integer|min:1',
        ]);

        // Ambil detail barang
        $detail = DetailBarang::where('no_barang', $no_barang)
            ->where('no_bahan', $no_bahan)
            ->firstOrFail();

        $qty_lama = $detail->qty_pakai;
        $qty_baru = $request->qty_pakai;
        $selisih = $qty_baru - $qty_lama;

        $bahan = BahanBaku::where('no_bahan', $no_bahan)->first();
        $stok_tersedia = $bahan->stok_bahan;

        if ($selisih > 0 && $selisih > $stok_tersedia) {
            return back()->with('error', "Stok bahan baku tidak mencukupi! Stok tersedia: {$stok_tersedia}");
        }

        $subtotal_baru = $qty_baru * $bahan->harga_beli;

        DB::transaction(function () use ($no_barang, $no_bahan, $qty_baru, $subtotal_baru, $selisih, $bahan) {
            DetailBarang::where('no_barang', $no_barang)
                ->where('no_bahan', $no_bahan)
                ->update([
                    'qty_pakai' => $qty_baru,
                    'subtotal_bom' => $subtotal_baru,
                ]);
            
            $bahan->decrement('stok_bahan', $selisih);
        });

        return redirect()->route('detail-barang.show', $no_barang)
            ->with('success', 'Detail barang berhasil diupdate!');
    }

        public function cetak($no_barang)
    {
        $barang = Barang::where('no_barang', $no_barang)->firstOrFail();
        $detailBarang = DetailBarang::with(['bahanBaku'])
            ->where('no_barang', $no_barang)
            ->get();
        $totalHpp = DetailBarang::where('no_barang', $no_barang)->sum('subtotal_bom');
        
        return view('detail-barang.cetak', compact('barang', 'detailBarang', 'totalHpp'));
    }

        public function destroy($id)
    {
        $parts = explode('-', $id);
        $no_barang = $parts[0] ?? null;
        $no_bahan = $parts[1] ?? null;
        
        if (!$no_barang || !$no_bahan) {
            abort(404, 'Data tidak ditemukan');
        }
        
        $detail = DetailBarang::where('no_barang', $no_barang)
            ->where('no_bahan', $no_bahan)
            ->firstOrFail();

        $qty = $detail->qty_pakai;
        $bahan = BahanBaku::where('no_bahan', $no_bahan)->first();

        DB::transaction(function () use ($no_barang, $no_bahan, $qty, $bahan) {
            // 1. KEMBALIKAN STOK bahan baku (karena bahan baku tidak dipakai lagi)
            $bahan->increment('stok_bahan', $qty);
            
            // 2. Hapus detail barang
            DetailBarang::where('no_barang', $no_barang)
                ->where('no_bahan', $no_bahan)
                ->delete();
        });

        return redirect()->route('detail-barang.show', $no_barang)
            ->with('success', 'Detail barang berhasil dihapus! Stok bahan baku dikembalikan.');
    }
}
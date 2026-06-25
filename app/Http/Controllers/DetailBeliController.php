<?php

namespace App\Http\Controllers;

use App\Models\DetailBeli;
use App\Models\Pembelian;
use App\Models\BahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailBeliController extends Controller
{
    public function create($no_beli)
    {
        $pembelian = Pembelian::findOrFail($no_beli);
        $bahanBaku = BahanBaku::all();

        return view('detailbeli.create', compact('pembelian', 'bahanBaku', 'no_beli'));
    }

    public function store(Request $request, $no_beli)
    {
        $request->validate([
            'no_bahan' => 'required|exists:bahan_baku,no_bahan',
            'qty_beli' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $no_beli) {
            // Cek apakah bahan sudah ada
            $exists = DetailBeli::where('no_beli', $no_beli)
                ->where('no_bahan', $request->no_bahan)
                ->exists();

            if ($exists) {
                return redirect()->back()->withErrors(['no_bahan' => 'Bahan baku sudah ada di detail pembelian ini!']);
            }

            // Ambil harga dari database
            $bahan = BahanBaku::find($request->no_bahan);
            $harga = $bahan->harga_beli;
            $subtotal = $request->qty_beli * $harga;

            // Simpan detail
            DetailBeli::create([
                'no_beli' => $no_beli,
                'no_bahan' => $request->no_bahan,
                'qty_beli' => $request->qty_beli,
                'subtotal_beli' => $subtotal,
            ]);

            // Tambah stok
            BahanBaku::where('no_bahan', $request->no_bahan)
                ->increment('stok_bahan', $request->qty_beli);

            // Update total pembelian
            $total = DetailBeli::where('no_beli', $no_beli)->sum('subtotal_beli');
            Pembelian::where('no_beli', $no_beli)->update(['total_beli' => $total]);
        });

        return redirect()->route('pembelian.show', $no_beli)
            ->with('success', 'Detail pembelian berhasil ditambahkan!');
    }

    public function edit($no_beli, $no_bahan)
    {
        $detail = DetailBeli::with(['pembelian', 'bahanBaku'])
            ->where('no_beli', $no_beli)
            ->where('no_bahan', $no_bahan)
            ->firstOrFail();

        $pembelian = Pembelian::findOrFail($no_beli); 
        $bahanBaku = BahanBaku::all();
        return view('detailbeli.edit', compact('detail', 'pembelian', 'bahanBaku'));
    }

    public function update(Request $request, $no_beli, $no_bahan)
    {
        $request->validate([
            'qty_beli' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $no_beli, $no_bahan) {
            // Ambil detail dulu
            $detail = DetailBeli::where('no_beli', $no_beli)
                ->where('no_bahan', $no_bahan)
                ->first();

            if (!$detail) {
                return redirect()->back()->withErrors(['error' => 'Detail tidak ditemukan!']);
            }

            // Ambil harga dari database
            $bahan = BahanBaku::find($no_bahan);
            $harga = $bahan->harga_beli;

            $qty_lama = $detail->qty_beli;
            $qty_baru = $request->qty_beli;
            $selisih = $qty_baru - $qty_lama;

            // Update stok
            BahanBaku::where('no_bahan', $no_bahan)
                ->increment('stok_bahan', $selisih);

            // Update detail PAKE where() langsung
            $subtotal = $qty_baru * $harga;
            DetailBeli::where('no_beli', $no_beli)
                ->where('no_bahan', $no_bahan)
                ->update([
                    'qty_beli' => $qty_baru,
                    'subtotal_beli' => $subtotal,
                ]);

            // Update total pembelian
            $total = DetailBeli::where('no_beli', $no_beli)->sum('subtotal_beli');
            Pembelian::where('no_beli', $no_beli)->update(['total_beli' => $total]);
        });

        return redirect()->route('pembelian.show', $no_beli)
            ->with('success', 'Detail pembelian berhasil diupdate!');
    }

    public function destroy($no_beli, $no_bahan)
    {
        DB::transaction(function () use ($no_beli, $no_bahan) {
            // Ambil detail dulu
            $detail = DetailBeli::where('no_beli', $no_beli)
                ->where('no_bahan', $no_bahan)
                ->first();

            if (!$detail) {
                return redirect()->back()->withErrors(['error' => 'Detail tidak ditemukan!']);
            }

            // Kurangi stok
            BahanBaku::where('no_bahan', $no_bahan)
                ->decrement('stok_bahan', $detail->qty_beli);

            // Hapus PAKE where() langsung
            DetailBeli::where('no_beli', $no_beli)
                ->where('no_bahan', $no_bahan)
                ->delete();

            // Update total
            $total = DetailBeli::where('no_beli', $no_beli)->sum('subtotal_beli');
            Pembelian::where('no_beli', $no_beli)->update(['total_beli' => $total]);
        });

        return redirect()->route('pembelian.show', $no_beli)
            ->with('success', 'Detail pembelian berhasil dihapus!');
    }
}
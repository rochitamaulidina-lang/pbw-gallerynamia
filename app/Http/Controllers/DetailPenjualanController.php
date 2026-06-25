<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPenjualanController extends Controller
{
    public function create($no_jual)
    {
        $penjualan = Penjualan::findOrFail($no_jual);
        $barang = Barang::all();
        return view('detailpenjualan.create', compact('penjualan', 'barang'));
    }

    public function store(Request $request, $no_jual)
    {
        $request->validate([
            'no_barang' => 'required|exists:barang,no_barang',
            'qty_jual' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $no_jual) {
            // Cek apakah barang sudah ada
            $exists = DetailPenjualan::where('no_jual', $no_jual)
                ->where('no_barang', $request->no_barang)
                ->exists();

            if ($exists) {
                return redirect()->back()->withErrors(['no_barang' => 'Barang sudah ada di detail penjualan ini!']);
            }

            // Ambil harga dari database
            $barang = Barang::find($request->no_barang);
            $harga = $barang->harga_barang;
            $subtotal = $request->qty_jual * $harga;

            // Cek stok
            if ($request->qty_jual > $barang->stok_barang) {
                return redirect()->back()->withErrors(['qty_jual' => 'Stok barang tidak mencukupi!']);
            }

            // Simpan detail
            DetailPenjualan::create([
                'no_jual' => $no_jual,
                'no_barang' => $request->no_barang,
                'qty_jual' => $request->qty_jual,
                'subtotal_jual' => $subtotal,
            ]);

            // Kurangi stok barang
            Barang::where('no_barang', $request->no_barang)
                ->decrement('stok_barang', $request->qty_jual);

            // Update total penjualan
            $this->updateTotalPenjualan($no_jual);
            $this->updateDp($no_jual);
        });

        return redirect()->route('penjualan.show', $no_jual)
            ->with('success', 'Detail penjualan berhasil ditambahkan!');
    }

    public function edit($no_jual, $no_barang)
    {
        $detail = DetailPenjualan::where('no_jual', $no_jual)
            ->where('no_barang', $no_barang)
            ->firstOrFail();

        $penjualan = Penjualan::findOrFail($no_jual);
        return view('detailpenjualan.edit', compact('detail', 'penjualan'));
    }

    public function update(Request $request, $no_jual, $no_barang)
    {
        $request->validate([
            'qty_jual' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $no_jual, $no_barang) {
            // Ambil detail dulu PAKE first() BUKAN firstOrFail()
            $detail = DetailPenjualan::where('no_jual', $no_jual)
                ->where('no_barang', $no_barang)
                ->first();

            if (!$detail) {
                return redirect()->back()->withErrors(['error' => 'Detail tidak ditemukan!']);
            }

            // Ambil barang dan harga dari database
            $barang = Barang::find($no_barang);
            $harga = $barang->harga_barang;

            $qty_lama = $detail->qty_jual;
            $qty_baru = $request->qty_jual;
            $selisih = $qty_baru - $qty_lama;

            // Cek stok
            if ($selisih > 0 && $selisih > $barang->stok_barang) {
                return redirect()->back()->withErrors(['qty_jual' => 'Stok barang tidak mencukupi!']);
            }

            // Update stok barang
            Barang::where('no_barang', $no_barang)
                ->decrement('stok_barang', $selisih);

            // Update detail PAKE where() LANGSUNG
            $subtotal = $qty_baru * $harga;
            DetailPenjualan::where('no_jual', $no_jual)
                ->where('no_barang', $no_barang)
                ->update([
                    'qty_jual' => $qty_baru,
                    'subtotal_jual' => $subtotal,
                ]);

            // Update total penjualan
            $this->updateTotalPenjualan($no_jual);
            $this->updateDp($no_jual);
        });

        return redirect()->route('penjualan.show', $no_jual)
            ->with('success', 'Detail penjualan berhasil diupdate!');
    }

    public function destroy($no_jual, $no_barang)
    {
        DB::transaction(function () use ($no_jual, $no_barang) {
            // Ambil detail dulu PAKE first() BUKAN firstOrFail()
            $detail = DetailPenjualan::where('no_jual', $no_jual)
                ->where('no_barang', $no_barang)
                ->first();

            if (!$detail) {
                return redirect()->back()->withErrors(['error' => 'Detail tidak ditemukan!']);
            }

            // Kembalikan stok
            Barang::where('no_barang', $no_barang)
                ->increment('stok_barang', $detail->qty_jual);

            // Hapus PAKE where() LANGSUNG
            DetailPenjualan::where('no_jual', $no_jual)
                ->where('no_barang', $no_barang)
                ->delete();

            // Update total penjualan
            $this->updateTotalPenjualan($no_jual);
            $this->updateDp($no_jual);
        });

        return redirect()->route('penjualan.show', $no_jual)
            ->with('success', 'Detail penjualan berhasil dihapus!');
    }

    private function updateTotalPenjualan($no_jual)
    {
        $total = DetailPenjualan::where('no_jual', $no_jual)->sum('subtotal_jual');
        Penjualan::where('no_jual', $no_jual)->update(['total_jual' => $total]);
    }

    private function updateDp($no_jual)
    {
        $penjualan = Penjualan::find($no_jual);
        if ($penjualan && $penjualan->dp > 0) {
            $dp_baru = round($penjualan->total_jual * 0.3);
            $sisa_baru = $penjualan->total_jual - $dp_baru;
            Penjualan::where('no_jual', $no_jual)->update([
                'dp' => $dp_baru,
                'sisa_bayar' => $sisa_baru
            ]);
        }
    }
}

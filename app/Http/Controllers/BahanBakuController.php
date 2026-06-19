<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    public function index(Request $request)
    {
        $sortColumn = $request->get('sort', 'no_bahan');
        $sortOrder = $request->get('order', 'DESC');

        $allowedColumns = ['no_bahan', 'nama_bahan', 'stok_bahan', 'satuan', 'stok_kritis', 'harga_beli'];
        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'no_bahan';
        }

        $sortOrder = ($sortOrder == 'DESC' || $sortOrder == 'ASC') ? $sortOrder : 'DESC';

        $bahanBaku = BahanBaku::orderBy($sortColumn, $sortOrder)->paginate(10);

        return view('bahanbaku.index', compact('bahanBaku', 'sortColumn', 'sortOrder'));
    }

    public function create()
    {
        return view('bahanbaku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_bahan' => 'required|string|unique:bahan_baku,no_bahan',
            'nama_bahan' => 'required|string|max:255',
            'stok_bahan' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'stok_kritis' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
        ]);

        $data = $request->only(['no_bahan', 'nama_bahan', 'stok_bahan', 'satuan', 'stok_kritis', 'harga_beli']);

        BahanBaku::create($data);

        return redirect()->route('bahanbaku.index')->with('success', 'Bahan baku berhasil ditambahkan!');
    }

    public function show($id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);
        return view('bahanbaku.show', compact('bahanBaku'));
    }

    public function edit($id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);
        return view('bahanbaku.edit', compact('bahanBaku'));
    }

    public function update(Request $request, $id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);

        $request->validate([
            'no_bahan' => 'required|string|unique:bahan_baku,no_bahan,' . $id . ',no_bahan',
            'nama_bahan' => 'required|string|max:255',
            'stok_bahan' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'stok_kritis' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
        ]);

        $data = $request->only(['nama_bahan', 'stok_bahan', 'satuan', 'stok_kritis', 'harga_beli']);

        $bahanBaku->update($data);

        return redirect()->route('bahanbaku.index')->with('success', 'Bahan baku berhasil diupdate!');
    }

    public function destroy($id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);
        $bahanBaku->delete();

        return redirect()->route('bahanbaku.index')->with('success', 'Bahan baku berhasil dihapus!');
    }
}
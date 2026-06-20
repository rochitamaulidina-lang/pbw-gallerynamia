<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $sortColumn = $request->get('sort', 'no_barang');
        $sortOrder = $request->get('order', 'DESC');

        $allowedColumns = ['no_barang', 'nama_barang', 'ukuran', 'stok_barang', 'harga_barang'];
        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'no_barang';
        }

        $sortOrder = ($sortOrder == 'DESC' || $sortOrder == 'ASC') ? $sortOrder : 'DESC';

        $barang = Barang::orderBy($sortColumn, $sortOrder)->paginate(10);

        return view('barang.index', compact('barang', 'sortColumn', 'sortOrder'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_barang' => 'required|string|unique:barang,no_barang',
            'nama_barang' => 'required|string|max:255',
            'ukuran' => 'required|string|max:50',
            'stok_barang' => 'required|integer|min:0',
            'harga_barang' => 'required|numeric|min:0',
        ]);

        $data = $request->only(['no_barang', 'nama_barang', 'ukuran', 'stok_barang', 'harga_barang']);

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.show', compact('barang'));
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'no_barang' => 'required|string|unique:barang,no_barang,' . $id . ',no_barang',  // ← PERBAIKAN UNIQUE
            'nama_barang' => 'required|string|max:255',
            'ukuran' => 'required|string|max:50',
            'stok_barang' => 'required|integer|min:0',
            'harga_barang' => 'required|numeric|min:0',
        ]);

        $data = $request->only(['nama_barang', 'ukuran', 'stok_barang', 'harga_barang']);

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
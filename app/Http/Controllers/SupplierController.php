<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // INDEX - Menampilkan daftar supplier
    public function index(Request $request)
    {
        $sortColumn = $request->get('sort', 'no_supplier');
        $sortOrder = $request->get('order', 'DESC');

        $allowedColumns = ['no_supplier', 'nama_supplier', 'alamat_supplier', 'tlp_supplier'];
        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'no_supplier';
        }

        $sortOrder = ($sortOrder == 'DESC' || $sortOrder == 'ASC') ? $sortOrder : 'DESC';

        $supplier = Supplier::orderBy($sortColumn, $sortOrder)->paginate(10);

        return view('supplier.index', compact('supplier', 'sortColumn', 'sortOrder'));
    }

    // CREATE - Menampilkan form tambah
    public function create()
    {
        return view('supplier.create');
    }

    // STORE - Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'no_supplier' => 'required|string|unique:supplier,no_supplier',
            'nama_supplier' => 'required|string|max:255',
            'alamat_supplier' => 'required|string',
            'tlp_supplier' => 'required|string|max:20'
        ]);

        // Hanya ambil field yang diizinkan (tanpa 'proses')
        $data = $request->only(['no_supplier', 'nama_supplier', 'alamat_supplier', 'tlp_supplier']);
        
        Supplier::create($data);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

    // SHOW - Menampilkan detail satu supplier (opsional)
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.show', compact('supplier'));
    }

    // EDIT - Menampilkan form edit
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    // UPDATE - Menyimpan perubahan
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat_supplier' => 'required|string',
            'tlp_supplier' => 'required|string|max:20'
        ]);

        // Hanya ambil field yang diizinkan
        $data = $request->only(['nama_supplier', 'alamat_supplier', 'tlp_supplier']);
        
        $supplier->update($data);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diupdate!');
    }

    // DESTROY - Menghapus data
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus!');
    }
}
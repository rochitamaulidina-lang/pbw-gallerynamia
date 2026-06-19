<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // INDEX - Menampilkan daftar pelanggan (pelanggan-lihat.php)
    public function index(Request $request)
    {
        // Ambil parameter sorting dari URL
        $sortColumn = $request->get('sort', 'no_pelanggan');
        $sortOrder = $request->get('order', 'DESC'); // Default DESC

        // Validasi column yang boleh di-sort
        $allowedColumns = ['no_pelanggan', 'nama_pelanggan', 'tlp_pelanggan', 'email_pelanggan'];
        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'no_pelanggan';
        }

        // Validasi order
        $sortOrder = ($sortOrder == 'DESC' || $sortOrder == 'ASC') ? $sortOrder : 'DESC';

        // Ambil data dengan sorting dan pagination (10 per halaman)
        $pelanggan = Pelanggan::orderBy($sortColumn, $sortOrder)->paginate(10);

        return view('pelanggan.index', compact('pelanggan', 'sortColumn', 'sortOrder'));
    }

    // CREATE - Menampilkan form tambah (pelanggan-tambah.php)
    public function create()
    {
        return view('pelanggan.create');
    }

    // STORE - Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'no_pelanggan' => 'required|string|unique:pelanggan,no_pelanggan',
            'nama_pelanggan' => 'required|string|max:255',
            'tlp_pelanggan' => 'required|string|max:20',
            'email_pelanggan' => 'nullable|email|max:255'
        ]);

        $data = $request->only(['no_pelanggan', 'nama_pelanggan', 'tlp_pelanggan', 'email_pelanggan']);

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    // SHOW - Menampilkan detail satu pelanggan (opsional)
    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.show', compact('pelanggan'));
    }

    // EDIT - Menampilkan form edit (pelanggan-ubah.php)
    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    // UPDATE - Menyimpan perubahan
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'tlp_pelanggan' => 'required|string|max:20',
            'email_pelanggan' => 'nullable|email|max:255'
        ]);

        $data = $request->only(['nama_pelanggan', 'tlp_pelanggan', 'email_pelanggan']);

        $pelanggan->update($data);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diupdate!');
    }

    // DESTROY - Menghapus data
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    // INDEX - Menampilkan daftar pegawai (pegawai-lihat.php)
    public function index(Request $request)
    {
        // Ambil parameter sorting dari URL
        $sortColumn = $request->get('sort', 'no_pegawai');
        $sortOrder = $request->get('order', 'DESC'); // Default DESC

        // Validasi column yang boleh di-sort
        $allowedColumns = ['no_pegawai', 'nama_pegawai', 'tlp_pegawai'];
        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'no_pegawai';
        }

        // Validasi order (hanya ASC atau DESC)
        $sortOrder = ($sortOrder == 'DESC' || $sortOrder == 'ASC') ? $sortOrder : 'DESC';

        // Ambil data dengan sorting dan pagination (10 per halaman)
        $pegawai = Pegawai::orderBy($sortColumn, $sortOrder)->paginate(10);

        // Kirim ke view
        return view('pegawai.index', compact('pegawai', 'sortColumn', 'sortOrder'));
    }

    // CREATE - Menampilkan form tambah (pegawai-tambah.php)
    public function create()
    {
        return view('pegawai.create');
    }

    // STORE - Menyimpan data baru (proses dari pegawai-tambah.php)
    public function store(Request $request)
    {
        $request->validate([
            'no_pegawai' => 'required|string|unique:pegawai,no_pegawai',
            'nama_pegawai' => 'required|string|max:255',
            'tlp_pegawai' => 'required|string|max:20',
            'ttd_pegawai' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $data = $request->only(['no_pegawai', 'nama_pegawai', 'tlp_pegawai']);

        // Upload TTD
        if ($request->hasFile('ttd_pegawai')) {
            $file = $request->file('ttd_pegawai');
            $fileName = $request->no_pegawai . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/ttd'), $fileName);
            $data['ttd_pegawai'] = $fileName;
        }

        Pegawai::create($data);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan!');
    }

    // SHOW - Menampilkan detail satu pegawai (opsional)
    public function show($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.show', compact('pegawai'));
    }

    // EDIT - Menampilkan form edit (pegawai-ubah.php)
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    // UPDATE - Menyimpan perubahan (proses dari pegawai-ubah.php)
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'tlp_pegawai' => 'required|string|max:20',
            'ttd_pegawai' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $data = $request->only(['nama_pegawai', 'tlp_pegawai']);

        // Handle hapus TTD
        if ($request->has('hapus_ttd') && $request->hapus_ttd == '1') {
            if ($pegawai->ttd_pegawai && file_exists(public_path('uploads/ttd/' . $pegawai->ttd_pegawai))) {
                unlink(public_path('uploads/ttd/' . $pegawai->ttd_pegawai));
            }
            $data['ttd_pegawai'] = null;
        }

        // Handle upload TTD baru
        if ($request->hasFile('ttd_pegawai')) {
            // Hapus file lama jika ada
            if ($pegawai->ttd_pegawai && file_exists(public_path('uploads/ttd/' . $pegawai->ttd_pegawai))) {
                unlink(public_path('uploads/ttd/' . $pegawai->ttd_pegawai));
            }
            $file = $request->file('ttd_pegawai');
            $fileName = $id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/ttd'), $fileName);
            $data['ttd_pegawai'] = $fileName;
        }

        $pegawai->update($data);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diupdate!');
    }

    // DESTROY - Menghapus data (pegawai-hapus.php)
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        // Hapus file TTD jika ada
        if ($pegawai->ttd_pegawai && file_exists(public_path('uploads/ttd/' . $pegawai->ttd_pegawai))) {
            unlink(public_path('uploads/ttd/' . $pegawai->ttd_pegawai));
        }

        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return 'Halaman daftar Pegawai (Coming Soon) - Silakan isi CRUD oleh tim'; 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return 'Form tambah Pegawai (Coming Soon)';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return 'Proses simpan Pegawai (Coming Soon)'; 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'Detail Pegawai (Coming Soon) ID: '.$id; //menampilan detail 1 record(optional)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return 'Form edit Pegawai (Coming Soon) ID: ' . $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return 'Proses update Pegawai (Coming Soon) ID: ' . $id; 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       return 'Proses hapus Pegawai (Coming Soon) ID: ' . $id; 
    }
}

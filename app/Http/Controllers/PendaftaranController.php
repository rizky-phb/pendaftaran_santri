<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::all();
        return view('form-pendaftaran', compact('pendaftarans'));
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\CreatePendaftaran::route('/create'),
        ];
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:pendaftarans,email',
            'no_hp'        => 'required|string|max:20|unique:pendaftarans,no_hp',
            'alamat'       => 'required|string|max:255',
        ], [
            'email.unique' => 'Email sudah terdaftar.',
            'no_hp.unique' => 'No HP sudah terdaftar.',
        ]);

        Pendaftaran::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'no_hp'        => $request->no_hp,
            'alamat'       => $request->alamat,
        ]);

        return redirect()->route('form-pendaftaran')->with('success', 'Data Dikirim Silakan Tunggu Konfirmasi Melalui Email agar dapat memulai proses pendaftaran sesuai tanggal yang telah ditentukan.');
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('pendaftaran.show', compact('pendaftaran'));
    }

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('pendaftaran.edit', compact('pendaftaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            // tambahkan validasi lain sesuai kebutuhan
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update($request->all());
        return redirect()->route('form-pendaftaran')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();
        return redirect()->route('form-pendaftaran')->with('success', 'Data berhasil dihapus');
    }
}

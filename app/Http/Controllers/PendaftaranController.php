<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Gelombang;
use App\Mail\AkunDibuatMail;
use App\Mail\EmailVerifikasiPendaftaran;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        // Validasi tanggal sekarang terhadap jadwal pendaftaran
        $today = Carbon::now();
        $gelombang = Gelombang::whereDate('tanggal_mulai', '<=', $today)
                        ->whereDate('tanggal_selesai', '>=', $today)
                        ->orderBy('tanggal_mulai')
                        ->first();

        if (!$gelombang) {
            $nextGelombang = Gelombang::whereDate('tanggal_mulai', '>', $today)->orderBy('tanggal_mulai')->first();

            if ($nextGelombang) {
                return redirect()->route('form-pendaftaran')->withErrors([
                    'msg' => 'Pendaftaran belum dibuka. Silakan cek kembali pada tanggal ' .
                        Carbon::parse($nextGelombang->tanggal_mulai)->format('d M Y') .
                        ' (Gelombang ' . $nextGelombang->gelombang . ').'
                ]);
            }

            return redirect()->route('form-pendaftaran')->withErrors([
                'msg' => 'Maaf, pendaftaran sudah ditutup dan tidak ada gelombang berikutnya.'
            ]);
        }
      // Validasi data form
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:pendaftarans,email',
            'no_hp'        => 'required|regex:/^[0-9]{10,20}$/|unique:pendaftarans,no_hp',
            'alamat'       => 'required|string|max:255',
        ], [
            'email.unique' => 'Email sudah terdaftar.',
            'no_hp.unique' => 'No HP sudah terdaftar.',
        ]);

        // Simpan data jika valid dan gelombang aktif
        $token = Str::random(64);

        $pendaftar = Pendaftaran::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'no_hp'        => $request->no_hp,
            'alamat'       => $request->alamat,
            'verification_token' => $token,
        ]);

        Mail::to($pendaftar->email)->send(new EmailVerifikasiPendaftaran($pendaftar));


        return redirect()->route('form-pendaftaran')->with('success', 'Pendaftaran berhasil! Silakan tunggu konfirmasi melalui email anda.');
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

public function formPassword($token)
{
    $pendaftar = Pendaftaran::where('verification_token', $token)->first();

    if (! $pendaftar) {
        return redirect('/')->withErrors(['msg' => 'Token verifikasi tidak valid atau sudah digunakan.']);
    }

    if ($pendaftar->email_verified_at) {
        return redirect('/user/login')->with('info', 'Email sudah diverifikasi. Silakan login.');
    }

    return view('verifikasi.form', [
        'pendaftar' => $pendaftar,
        'token' => $token,
    ]);
}
    public function setPassword(Request $request, $token)
{
    $request->validate([
        'password' => 'required|min:6|confirmed',
    ]);
    $pendaftar = Pendaftaran::where('verification_token', $token)->firstOrFail();

    if ($pendaftar->email_verified_at) {
        return redirect('/user/login')->with('message', 'Email sudah diverifikasi. Silakan login.');
    }

    $user = User::create([
        'name' => $pendaftar->nama_lengkap,
        'email' => $pendaftar->email,
        'password' => bcrypt($request->password),
        'role' => 'user',
    ]);
    $pembayaranItems = [
        ['jenis' => 'Pendaftaran Pondok', 'jumlah' => 170000],
        ['jenis' => 'Pendaftaran Madin', 'jumlah' => 170000],
        ['jenis' => 'Muawanah', 'jumlah' => 850000],
        ['jenis' => 'Seragam Olah Raga Pondok', 'jumlah' => 360000],
        ['jenis' => 'Jas Almamater', 'jumlah' => 240000],
        ['jenis' => 'Kitab Pengajian', 'jumlah' => 995000],
        ['jenis' => 'Atribut Pondok & Batik Madin', 'jumlah' => 385000],
        ['jenis' => 'Kartu Santri', 'jumlah' => 80000],
        ['jenis' => 'DP Awal Ziarah', 'jumlah' => 500000],
        ['jenis' => 'MOS', 'jumlah' => 140000],
        ['jenis' => 'Sariah Pondok', 'jumlah' => 160000],
        ['jenis' => 'Sariah Madrasah', 'jumlah' => 140000],
        ['jenis' => 'Makan', 'jumlah' => 450000],
        ['jenis' => 'Kegiatan Santri', 'jumlah' => 100000],
        ['jenis' => 'Materai', 'jumlah' => 10000],
    ];

    foreach ($pembayaranItems as $item) {
        Pembayaran::create([
            'user_id' => $user->id,
            'jenis_pembayaran' => $item['jenis'],
            'jumlah' => $item['jumlah'],
            'status' => 'menunggu',
        ]);
    }

    $pendaftar->update([
        'email_verified_at' => now(),
        'status' => 'terverifikasi',
    ]);

    // Redirect ke login atau login otomatis
    return redirect('/user/login')->with('success', 'Akun berhasil dibuat. Silakan login.');
}

}

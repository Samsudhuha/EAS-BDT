<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Pinjams;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function index()
    {
        $data['data'] = Pinjams::with(['Buku'])->get();

        return view('pinjam.index', $data);
    }

    public function form()
    {
        $data['data'] = Books::all();

        return view('pinjam.form', $data);
    }

    public function post(Request $request)
    {
        $data = [
            'peminjam' => $request->peminjam,
            'buku_id' => $request->buku,
            'jaminan' => $request->jaminan,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => '-',
            'flag_kembali' => 0,
            'denda' => '-',
        ];

        Pinjams::create($data);

        return redirect('pinjam')->with('success', 'Peminjaman berhasil, Silahkan Kembalikan Buku 1 Hari Setelah Peminjaman!');
    }

    public function update(Request $request)
    {
        $waktu = date('d/m/Y');
        $data = [
            'tanggal_kembali' => $waktu,
            'flag_kembali' => 1
        ];

        Pinjams::where('id', $request->id)->update($data);

        return redirect('pinjam')->with('success', 'Buku Telah Dikembalikan!');
    }

    public function delete(Request $request)
    {
        Pinjams::where('id', $request->id)->delete();

        return redirect('pinjam')->with('success', 'Peminjaman berhasil dihapus');
    }
}

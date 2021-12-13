<?php

namespace App\Http\Controllers;

use App\Models\Raks;
use Illuminate\Http\Request;

class RaksController extends Controller
{
    public function index()
    {
        $data['data'] = Raks::all();

        return view('rak.index', $data);
    }

    public function form()
    {
        return view('rak.form');
    }

    public function post(Request $request)
    {
        $data = [
            'lokasi' => $request->lokasi
        ];

        Raks::create($data);

        return redirect('rak')->with('success', 'Lokasi berhasil ditambah');
    }

    public function edit($id)
    {
        $data['data'] = Raks::where('id', $id)->first();

        return view('rak.edit', $data);
    }

    public function update(Request $request)
    {
        $data = [
            'lokasi' => $request->lokasi
        ];

        Raks::where('id', $request->id)->update($data);

        return redirect('rak')->with('success', 'Lokasi berhasil diubah');
    }

    public function delete(Request $request)
    {
        Raks::where('id', $request->id)->delete();

        return redirect('rak')->with('success', 'Lokasi berhasil dihapus');
    }
}

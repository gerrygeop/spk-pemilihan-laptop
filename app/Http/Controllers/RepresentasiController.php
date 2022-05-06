<?php

namespace App\Http\Controllers;

use App\Models\Representasi;
use App\Models\Kriteria;
use App\Http\Requests\RepresentasiRequest;

class RepresentasiController extends Controller
{
    public function index()
    {
        $representasi = Representasi::with('kriteria')->get();
        $all_kriteria = Kriteria::all();
        return view('dapur.representasi.index', compact('representasi', 'all_kriteria'));
    }

    public function create(Kriteria $kriteria)
    {
        $representasi = new Representasi;
        return view('dapur.representasi.create', compact('representasi', 'kriteria'));
    }

    public function store(RepresentasiRequest $request, Kriteria $kriteria)
    {
        $validate = $request->validated();
        $validate['kriteria_id'] = $kriteria->id;
        $rep = Representasi::create($validate);

        return redirect()
            ->route('d.representasi.index')
            ->with('success', "Representasi kriteria ". $kriteria->nama. " berhasil ditambahkan");
    }

    public function edit(Kriteria $kriteria, Representasi $representasi)
    {
        return view('dapur.representasi.edit', compact('representasi', 'kriteria'));
    }

    public function update(RepresentasiRequest $request, Representasi $representasi)
    {
        $validate = $request->validated();
        $representasi->update($validate);

        return redirect()
            ->route('d.representasi.index')
            ->with('success', "Representasi kriteria ". $representasi->kriteria->nama. " berhasil diperbarui");
    }

    public function destroy(Kriteria $kriteria, Representasi $representasi)
    {
        $representasi->delete();
        return redirect()->route('d.representasi.index')->with('success', 'Representasi kriteria '. $kriteria->nama .' berhasil dihapus');
    }
}

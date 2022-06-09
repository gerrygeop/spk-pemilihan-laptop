<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Http\Requests\KriteriaRequest;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Http\Traits\ColumnTrait;

class KriteriaController extends Controller
{
    use ColumnTrait;

    public function index()
    {
        $all_kriteria = Kriteria::orderBy('kode')->get();
        return view('dapur.kriteria.index', compact('all_kriteria'));
    }

    public function create()
    {
        $kriteria = new Kriteria;
        return view('dapur.kriteria.create', compact('kriteria'));
    }

    public function store(KriteriaRequest $request)
    {
        $this->checkIfNameExists($request->nama);

        $validate = $request->validated();
        $kriteria = Kriteria::create($validate);

        $this->addAlternatifColumn($kriteria->nama, $validate['type_inputan']);
        $this->addAlternatifMaxBobotColumn($kriteria->nama);
        
        return redirect()->route('d.kriteria.index')->with('success', 'Kriteria berhasil ditambah');
    }

    public function show(Kriteria $kriteria)
    {
        //
    }

    public function edit(Kriteria $kriteria)
    {
        return view('dapur.kriteria.edit', compact('kriteria'));
    }

    public function update(KriteriaRequest $request, Kriteria $kriteria)
    {
        $validate = $request->validated();
        if ( $kriteria->type_inputan != $validate['type_inputan'] ) {
            $this->updateAlternatifColumnType($kriteria->nama, $validate['type_inputan']); 
        }
        if ( $kriteria->nama != $validate['nama'] ) {
            $this->updateAlternatifColumnName($validate['nama'], $kriteria->nama); 
            $this->updateAlternatifMaxBobotColumnName($validate['nama'], $kriteria->nama); 
        }
        
        $kriteria->update($validate);
        return redirect()->route('d.kriteria.index')->with('success', 'Kriteria berhasil diubah');
    }

    public function destroy(Kriteria $kriteria)
    {
        $columnName = Str::of($kriteria->nama)->slug('_');
        if ( $this->columnExists($columnName) ) {
            $this->dropAlternatifColumn($columnName);
        }
        
        $kriteria->delete();
        return redirect()->route('d.kriteria.index')->with('success', 'Kriteria berhasil dihapus');
    }

}

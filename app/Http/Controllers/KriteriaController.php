<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Http\Requests\KriteriaRequest;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class KriteriaController extends Controller
{
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

    private function checkIfNameExists($columnName)
    {
        $columnName = Str::of($columnName)->slug('_');
        if ( $this->columnExists($columnName) ) { 
            return back()->with('name_exists', 'Nama kriteria sudah ada'); 
        }
    }

    private function columnExists($columnName)
    {
        if ( Schema::hasColumn('alternatifs', $columnName) ) {
            return true;
        }
        return false;
    }

    private function addAlternatifColumn($columnName, $typeInputan = null)
    {
        $columnName = Str::of($columnName)->slug('_');
        Schema::table('alternatifs', function (Blueprint $table) use ($columnName, $typeInputan) {
            switch ($typeInputan) {
                case 'string':
                    $table->string($columnName)->nullable();
                    break;
                case 'integer':
                    $table->integer($columnName)->nullable();
                    break;
                case 'float':
                    $table->float($columnName, 0)->nullable();
                    break;
                default:
                    $table->string($columnName)->nullable();
            }
        });
    }

    private function updateAlternatifColumnName($newName, $oldName)
    {
        $newName = $this->toSlug($newName);
        $oldName = $this->toSlug($oldName);
        Schema::table('alternatifs', function (Blueprint $table) use ($newName, $oldName) {
            $table->renameColumn($oldName, $newName);
        });
    }

    private function updateAlternatifColumnType($columnName, $typeInputan) 
    {
        $columnName = Str::of($columnName)->slug('_');
        Schema::table('alternatifs', function (Blueprint $table) use ($columnName, $typeInputan) {
            switch ($typeInputan) {
                case 'string':
                    $table->string($columnName)->nullable()->change();
                    break;
                case 'integer':
                    $table->integer($columnName)->nullable()->change();
                    break;
                case 'float':
                    $table->float($columnName, 0)->nullable()->change();
                    break;
                default:
                    $table->string($columnName)->nullable()->change();
            }
        });
    }

    private function dropAlternatifColumn($columnName)
    {
        Schema::table('alternatifs', function (Blueprint $table) use ($columnName) {
            $table->dropColumn($columnName);
        });
    }

    private function toSlug($text)
    {
        $text = trim($text);
        $text = strtolower($text);
        $text = str_replace(" ","_", $text);
        return $text;
    }
}

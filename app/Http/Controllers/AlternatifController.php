<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifMaxBobot;
use App\Models\Kriteria;
use App\Models\Representasi;

use App\Http\Services\AlternatifService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AlternatifController extends Controller
{
    public $except  = [0, 1, 2, 3];

    public function index()
    {
        $all_alternatif = Alternatif::with('alternatif_max_bobot')->get();
        return view('dapur.alternatif.index', compact('all_alternatif'));
    }

    public function create()
    {
        $alternatif = new Alternatif;
        $alternatifColumn = $this->getColumnList($alternatif);
        $alternatifColumn = Arr::except($alternatifColumn, $this->except);
        $kriterias = Kriteria::all();

        return view('dapur.alternatif.create', compact('alternatif', 'alternatifColumn', 'kriterias'));
    }

    public function store(Request $request)
    {
        $alternatif = Alternatif::create($request->except('_token'));
        return redirect()->route('d.alternatif.show', $alternatif)->with('success', 'Alternatif berhasil ditambah');
    }

    public function show(Alternatif $alternatif)
    {
        $alt = new Alternatif;

        $alternatifColumn = $this->getColumnList($alt);
        $alternatifColumn = Arr::except($alternatifColumn, $this->except);

        return view('dapur.alternatif.show', [
            'alternatif' => $alternatif->load('alternatif_max_bobot'),
            'alternatifColumn' => $alternatifColumn,
        ]);
    }

    public function edit(Alternatif $alternatif)
    {
        $alternatifColumn = $this->getColumnList($alternatif);
        $alternatifColumn = Arr::except($alternatifColumn, $this->except);
        $kriterias = Kriteria::all();

        return view('dapur.alternatif.edit', compact('alternatif', 'alternatifColumn', 'kriterias'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $alternatif->update($request->except('_token'));
        return redirect()->route('d.alternatif.show', $alternatif)->with('success', 'Alternatif berhasil diubah');
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();
        return redirect()->route('d.alternatif.index')->with('success', 'Alternatif berhasil dihapus');
    }

    public function storeMaxBobot(Alternatif $alternatif, AlternatifService $service)
    {
        $representasi = Representasi::with('kriteria')->get();
        $representasi = $representasi->groupBy('kriteria_id');
        $alt = collect($alternatif)->except(['id', 'nama', 'created_at', 'updated_at']);

        $arr = $service->getAlternatifMaxBobot($alt, $representasi);
        $arr['alternatif_id'] = $alternatif->id;

        AlternatifMaxBobot::create($arr);

        return back()->with('success', 'Berhasil menghitung nilai max bobot');
    }

    public function updateMaxBobot(Alternatif $alternatif, AlternatifService $service)
    {
        $representasi = Representasi::with('kriteria')->get();
        $representasi = $representasi->groupBy('kriteria_id');
        $alt = collect($alternatif)->except(['id', 'nama', 'created_at', 'updated_at']);

        $arr = $service->getAlternatifMaxBobot($alt, $representasi);

        $alternatif->alternatif_max_bobot()->update($arr);

        return back()->with('success', 'Berhasil mengubah nilai max bobot');
    }

    private function getColumnList($alt)
    {
        return $alt->getConnection()->getSchemaBuilder()->getColumnListing('alternatifs');
    }
}

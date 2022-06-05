<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AlternatifController extends Controller
{
    public function index()
    {
        $all_alternatif = Alternatif::all();
        return view('dapur.alternatif.index', compact('all_alternatif'));
    }

    public function create()
    {
        $alternatif = new Alternatif;
        $alternatifColumn = $alternatif->getConnection()->getSchemaBuilder()->getColumnListing('alternatifs');
        $alternatifColumn = Arr::except($alternatifColumn, [0, 1, 2, 3]);
        return view('dapur.alternatif.create', compact('alternatif', 'alternatifColumn'));
    }

    public function store(Request $request)
    {
        Alternatif::create($request->except('_token'));
        return redirect()->route('d.alternatif.index')->with('success', 'Alternatif berhasil ditambah');
    }

    public function show(Alternatif $alternatif)
    {
        $alt = new Alternatif;
        $alternatifColumn = $alt->getConnection()->getSchemaBuilder()->getColumnListing('alternatifs');
        $alternatifColumn = Arr::except($alternatifColumn, [0, 1, 2, 3]);
        return view('dapur.alternatif.show', compact('alternatif', 'alternatifColumn'));
    }

    public function edit(Alternatif $alternatif)
    {
        $alternatifColumn = $alternatif->getConnection()->getSchemaBuilder()->getColumnListing('alternatifs');
        $alternatifColumn = Arr::except($alternatifColumn, [0, 1, 2, 3, 4]);
        return view('dapur.alternatif.edit', compact('alternatif', 'alternatifColumn'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $alternatif->update($request->except('_token'));
        return redirect()->route('d.alternatif.index')->with('success', 'Alternatif berhasil ditambah');
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();
        return redirect()->route('d.alternatif.index')->with('success', 'Alternatif berhasil dihapus');
    }
}

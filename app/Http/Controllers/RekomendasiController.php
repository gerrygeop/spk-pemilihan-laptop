<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\{Arr, Str};
use App\Http\Services\RekomendasiService;
use App\Models\{Alternatif, Representasi, Rekomendation, Calculation};
use Carbon\Carbon;

class RekomendasiController extends Controller
{
    public function index()
    {
        $rekomendasi = Rekomendation::with('alternatif')
            ->where('user_id', auth()->user()->id)
            ->get()
            ->groupBy(function($item) {
                return Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y  hh:mm:ss');
            });

        return view('tamu.rekomendasi.index', compact('rekomendasi'));
    }

    public function result($slug)
    {
        $rekomendasi = Rekomendation::with('alternatif')->where('slug', $slug)->get();
        return view('tamu.rekomendasi.result', compact('rekomendasi', 'slug'));
    }

    public function calculation($slug, RekomendasiService $service)
    {
        $calculation = Calculation::where('slug', $slug)->get();
        $array = $service->calculationHistory($calculation, $slug);
        return view('tamu.rekomendasi.calculation', compact('calculation', 'slug', 'array'));
    }

    public function show(Alternatif $alternatif, $slug = null)
    {
        $alternatifColumn = $this->getColumn();
        return view('tamu.rekomendasi.show', compact('alternatif', 'alternatifColumn', 'slug'));
    }

    public function store(Request $request, RekomendasiService $service)
    {
        $slug = Str::random(10).time();
        $rekomendasi = $service->calculationResults($request->except('_token'), $slug);

        if ( is_null($rekomendasi) ) {
            return redirect()->route('home')->with('not_found', 'Tidak ada rekomendasi yang sesuai dengan kriteria yang dipilih');
            
        } else {
            $alternatif = Alternatif::whereIn('id', array_keys($rekomendasi))->get(['id', 'nama']);
            $alternatif = $alternatif->pluck('id')->combine($alternatif->pluck('nama'))->toArray();
    
            $now = Carbon::now();
    
            foreach ($rekomendasi as $key => $value) {
                $rek[] = [
                    'slug' => $slug,
                    'user_id' => auth()->user()->id,
                    'alternatif_id' => $key,
                    'bobot' => $value,
                    'created_at' => $now,
                ];
            }
    
            Rekomendation::insert($rek);
    
            return redirect()->route('rekomendasi.result', $slug)->with('new_results', 'Hasil rekomendasi dari pencarian anda');
        }

    }

    /* Function edit, update, destroy
        public function edit($id)
        {
            //
        }

        public function update(Request $request, $id)
        {
            //
        }

        public function destroy($id)
        {
            //
        }
    */

    private function getColumn()
    {
        $alt = new Alternatif;
        $alternatifColumn = $alt->getConnection()->getSchemaBuilder()->getColumnListing('alternatifs');
        $alternatifColumn = Arr::except($alternatifColumn, [0, 1, 2, 3]);
        return $alternatifColumn;
    }
}

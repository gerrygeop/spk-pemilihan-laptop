<?php

namespace App\Http\Services;

use App\Models\{Kriteria, Representasi, Alternatif, AlternatifMaxBobot};
use Illuminate\Support\{Str, Arr};

class RekomendasiService
{

    public function selectAlternatif($request)
    {
        $kriteria = Kriteria::with('representasi')->whereIn('id', array_keys($request))->get(['nama', 'keterangan', 'bobot']);
        $representasi = Representasi::whereIn('keterangan', $request)->get(['keterangan'])->pluck('keterangan');
        $representasi = $representasi->combine($representasi)->toArray();

        $kriteria_nama = $kriteria->pluck('nama');
        $kriteria_nama_slug = $kriteria_nama->map(fn ($value, $key) => Str::slug($value, '_') );
        $kriteria_collect = $kriteria_nama_slug->combine($request);

        foreach ( $kriteria_collect as $key => $value ) {
            if ( isset($representasi[$value]) ) {
                $arr[] = [$key, '=', $value];
            } else {
                $arr[] = [$key, '<=', $value];
            }
        }
        
        $alternatif = Alternatif::where($arr)->get();

        if ( ($alternatif)->isEmpty() ) {
            return null;
        }

        $alternatif_nama = $alternatif->pluck('nama')->toArray();
        $alternatif_id = $alternatif->pluck('id')->toArray();

        $alternatif_max = AlternatifMaxBobot::whereIn('alternatif_id', $alternatif_id)->get($kriteria_nama_slug->toArray());

        foreach ( $kriteria as $ktr_key => $ktr ) {
            $ktr_slug = Str::slug($ktr->nama, '_');

            foreach ( $alternatif_max as $alt_key => $alt_max_bobot ) {
                if ( $alt_max_bobot[$ktr_slug] && $ktr->keterangan === 'cost' ) {
                    $arr_alt[$ktr_slug][] = $alt_max_bobot[$ktr_slug];
                    $arr_min_max[$ktr_slug] = min($arr_alt[$ktr_slug]);
                } else {
                    $arr_alt[$ktr_slug][] = $alt_max_bobot[$ktr_slug];
                    $arr_min_max[$ktr_slug] = max($arr_alt[$ktr_slug]);
                }
            }
            // return dd($arr_min_max);

            foreach ( $arr_alt[$ktr_slug] as $key => $value ) {
                if ( $ktr->keterangan === 'cost' ) {
                    $alt_min_max[$ktr_slug][] = $arr_min_max[$ktr_slug] / $value;
                } else {
                    $alt_min_max[$ktr_slug][] = $value / $arr_min_max[$ktr_slug];
                }
            }
            // return dd($alt_min_max);

            foreach ( $alt_min_max[$ktr_slug] as $key => $value ) {
                $kali_bobot_ktr[$ktr_key][] = $value * $ktr->bobot;
            }
            // return dd($kali_bobot_ktr);
        }

        for ( $i=0; $i < count($kali_bobot_ktr); $i++ ) { 
            for ( $j=0; $j < count($kali_bobot_ktr[$i]); $j++ ) { 
                $sum_bobot[$j][] = $kali_bobot_ktr[$i][$j];
            }
        }

        foreach ( $alternatif_id as $alt_key => $alt_nama ) {
            $final_alt[$alt_nama] = array_sum($sum_bobot[$alt_key]);
        }
        // return dd($final_alt);

        return $final_alt;
    }

}
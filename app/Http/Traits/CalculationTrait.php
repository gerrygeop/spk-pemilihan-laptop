<?php

namespace App\Http\Traits;

use App\Models\AlternatifMaxBobot;
use Illuminate\Support\Str;

trait CalculationTrait {

    public function fuzzyCalculations($kriteria, $alternatif_id)
    {
        $kriteria_nama_slug = $this->collectionToSlug($kriteria);
        $alternatif_max = AlternatifMaxBobot::whereIn('alternatif_id', $alternatif_id)->orderBy('alternatif_id')->get($kriteria_nama_slug->toArray());
        // return dd($alternatif_max);

        foreach ( $kriteria as $ktr_key => $ktr ) {
            $ktr_slug = Str::slug($ktr->nama, '_');

            /* Loop alternatif yang terpilih (nilai max bobot dari setiap kriteria) */
            foreach ( $alternatif_max as $alt_key => $alt_max_bobot ) {
                /*  Jika kriteria merupakan 'cost' maka cari 
                    nilai terkecil (MIN) dari alternatif yang terpilih */
                if ( $alt_max_bobot[$ktr_slug] && $ktr->keterangan === 'cost' ) {
                    $arr_alt[$ktr_slug][] = $alt_max_bobot[$ktr_slug];
                    $arr_min_max[$ktr_slug] = min($arr_alt[$ktr_slug]);
                }
                /*  Jika kriteria merupakan 'benefit' maka cari 
                    nilai terbesar (MAX) dari alternatif yang terpilih */
                else {
                    $arr_alt[$ktr_slug][] = $alt_max_bobot[$ktr_slug];
                    $arr_min_max[$ktr_slug] = max($arr_alt[$ktr_slug]);
                }
            }
            // return dd($arr_min_max);

            foreach ( $arr_alt[$ktr_slug] as $key => $value ) {
                /*  Jika kriteria merupkan 'cost' maka bobot terkecil (MIN) dari alternatif terpilih 
                    dibagi dengan nilai yang diinputkan oleh user   */
                if ( $ktr->keterangan === 'cost' ) {
                    $alt_min_max[$ktr_slug][] = $arr_min_max[$ktr_slug] / $value;
                } 
                /*  Sebaliknya jika 'benefit' maka nilai yang diinputkan oleh user yang
                    dibagi dengan bobot terbesar (MAX) dari alterantif yang terpilih    */
                else {
                    $alt_min_max[$ktr_slug][] = $value / $arr_min_max[$ktr_slug];
                }
            }
            // return dd($alt_min_max);

            /*  Loop semua alternatif yang telah dibagi (berdasarkan kriteria)
                lalu dikalikan dengan bobot kriterria   */
            foreach ( $alt_min_max[$ktr_slug] as $key => $value ) {
                $kali_bobot_ktr[$ktr_key][] = $value * $ktr->bobot;
            }
        }

        $arr['bobot_alt'] = $arr_alt;
        $arr['min_max_alt'] = $arr_min_max;
        $arr['min_max_dibagi'] = $alt_min_max;
        $arr['kali_bobot_ktr'] = $kali_bobot_ktr;
        return $arr;
    }

    public function combineAlternatifValueOfEachKtriteria($kali_bobot_ktr)
    {
        /* Gabungkan nilai alternatif dari setiap kriteria-nya */
        for ( $i=0; $i < count($kali_bobot_ktr); $i++ ) { 
            for ( $j=0; $j < count($kali_bobot_ktr[$i]); $j++ ) { 
                $alt_values[$j][] = $kali_bobot_ktr[$i][$j];
            }
        }
        return $alt_values;
    }

    public function sumAlternatifValues($alternatif_id, $alt_values)
    {
        foreach ( $alternatif_id as $alt_key => $alt_nama ) {
            $sum_alt[$alt_nama] = array_sum($alt_values[$alt_key]);
        }
        return $sum_alt;
    }

    public function collectionToSlug($kriteria)
    {
        return $kriteria->pluck('nama')->map(fn ($value, $key) => Str::slug($value, '_') );
    }

}
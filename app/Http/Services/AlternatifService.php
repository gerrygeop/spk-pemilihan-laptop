<?php

namespace App\Http\Services;

use Illuminate\Support\Str;
use App\Http\Traits\ColumnAlternatifTrait;

class AlternatifService
{
    use ColumnAlternatifTrait;

    public function getAlternatifMaxBobot($alternatif, $representasi)
    {
        foreach ($representasi as $key_reps => $reps) { // Loop representasi
            foreach ($reps as $key_rep => $rep) { // Loop representasi
                $slug = $this->toSlug($rep->kriteria->nama);

                foreach ($alternatif as $key_alt => $value_alt) { // Loop alternatif yang diinput
                    if ( $slug == $key_alt ) {

                        // filter kategory alternatif value (low, medium, high)
                        switch ($key_rep) {
                            case 0: // low
                                if ( is_null($rep->nilai) ) { // if representasi menggunakan min - max
                                    if ( $value_alt <= $rep->min ) {
                                        $arr[$key_alt][$rep->keterangan] = 1;
                                    }
                                    if ( $value_alt > $rep->min && $value_alt < $rep->max ) {
                                        $arr[$key_alt][$rep->keterangan] = ( $rep->max - $value_alt ) / ( $rep->max - $rep->min );
                                    }
                                    if ( $value_alt >= $rep->max ) {
                                        $arr[$key_alt][$rep->keterangan] = 0;
                                    }
                
                                } else {
                                    if ( $value_alt == $rep->keterangan ) {
                                        $arr[$key_alt][$rep->keterangan] = $rep->nilai;
                                    }
                                }
                                break;
                
                            case 1: // medium
                                if ( is_null($rep->nilai) ) { // if representasi menggunakan min-max
                                    $rep_mid = ($rep->max + $rep->min) / 2; // nilai tengah dari min-max

                                    if ( $value_alt <= $rep->min || $value_alt >= $rep->max ) {
                                        $arr[$key_alt][$rep->keterangan] = 0;
                                    }
                                    if ( $value_alt > $rep->min && $value_alt <= $rep_mid ) {
                                        $arr[$key_alt][$rep->keterangan] = ( $value_alt - $rep->min ) / ( $rep_mid - $rep->min );
                                    }
                                    if ( $value_alt > $rep_mid && $value_alt < $rep->max ) {
                                        $arr[$key_alt][$rep->keterangan] = ( $rep->max - $value_alt ) / ( $rep->max - $rep_mid );
                                    }
                
                                } else {
                                    if ( $value_alt == $rep->keterangan ) {
                                        $arr[$key_alt][$rep->keterangan] = $rep->nilai;
                                    }
                                }
                                break;
                
                            case 2: // high
                                if ( is_null($rep->nilai) ) { // if representasi menggunakan min-max
                                    if ( $value_alt <= $rep->min ) {
                                        $arr[$key_alt][$rep->keterangan] = 0;
                                    }
                                    if ( $value_alt > $rep->min && $value_alt <= $rep->max ) {
                                        $arr[$key_alt][$rep->keterangan] = ( $value_alt - $rep->min ) / ( $rep->max - $rep->min );
                                    }
                                    if ( $value_alt > $rep->max ) {
                                        $arr[$key_alt][$rep->keterangan] = 1;
                                    }
                
                                } else {
                                    if ( $value_alt == $rep->keterangan ) {
                                        $arr[$key_alt][$rep->keterangan] = $rep->nilai;
                                    }

                                }
                                break;
                
                            default:
                                $arr['error'] = '404';
                                break;
                        }

                    }
                }

            }
        }

        // max bobot
        foreach ($arr as $key => $value) {
            $bobot[$key] = max($value);
        }

        return $bobot;
    }
}

<?php

namespace App\Http\Services;

use App\Models\{Kriteria, Representasi, Alternatif, AlternatifMaxBobot, Calculation};
use Illuminate\Support\{Str, Arr};
use Carbon\Carbon;
use App\Http\Traits\CalculationTrait;

class RekomendasiService
{
    use CalculationTrait;

    public function getRepresentasiKeterangan($keterangan)
    {
        $representasi = Representasi::whereIn('keterangan', $keterangan)->get(['keterangan'])->pluck('keterangan');
        return $representasi = $representasi->combine($representasi)->toArray();
    }

    public function getManyKriteriaById($kriteria_id)
    {
        return Kriteria::whereIn('id', $kriteria_id)->get(['nama', 'keterangan', 'bobot']);
    }

    public function saveKriteriaInput($request, $slug)
    {
        $now = Carbon::now();
        foreach ($request as $key => $value) {
            $arr[] = [
                'slug' => $slug,
                'user_id' => auth()->user()->id,
                'kriteria_id' => $key,
                'value' => $value,
                'created_at' => $now,
            ];
        }

        $cal = Calculation::insert($arr);
        return $cal;
    }

    public function getAlternatif($kriteria, $request)
    {
        $representasi = $this->getRepresentasiKeterangan($request);
        $kriteria_nama_slug = $this->collectionToSlug($kriteria);
        $kriteria_nama_slug = $kriteria_nama_slug->combine($request);

        foreach ( $kriteria_nama_slug as $key => $value ) {
            if ( isset($representasi[$value]) ) {
                $where[] = [$key, '=', $value];
            } else {
                $where[] = [$key, '<=', $value];
            }
        }

        return Alternatif::where($where)->get();
    }

    public function calculationResults($request, $slug)
    {
        $kriteria = $this->getManyKriteriaById(array_keys($request));
        $alternatif = $this->getAlternatif($kriteria, $request);
        
        if ( ($alternatif)->isNotEmpty() && $this->saveKriteriaInput($request, $slug) ) {
            $alternatif_id = $alternatif->pluck('id')->toArray();
            $arr = $this->fuzzyCalculations($kriteria, $alternatif_id);
            $alt_values = $this->combineAlternatifValueOfEachKtriteria($arr['kali_bobot_ktr']);
            $sum_alt = $this->sumAlternatifValues($alternatif_id, $alt_values);
            return $sum_alt;

        } else {
            return null;
        }
    }

    public function calculationHistory($calculation, $slug)
    {
        $kriteria_id = $calculation->pluck('kriteria_id')->toArray();
        $value = $calculation->pluck('value')->toArray();

        $kriteria = $this->getManyKriteriaById($kriteria_id);
        $alternatif = $this->getAlternatif($kriteria, $value);
        
        if ( ($alternatif)->isNotEmpty() ) {
            $alternatif_id = $alternatif->pluck('id')->toArray();
            $arr = $this->fuzzyCalculations($kriteria, $alternatif_id);
            $alt_values = $this->combineAlternatifValueOfEachKtriteria($arr['kali_bobot_ktr']);
            $sum_alt = $this->sumAlternatifValues($alternatif_id, $alt_values);
            
            $arr['ktr'] = $kriteria->pluck('nama')->toArray();
            $arr['ktr_bobot'] = $kriteria->pluck('nama')->combine($kriteria->pluck('bobot'));
            $arr['alternatif'] = $alternatif;
            $arr['sum_alt'] = $sum_alt;
            $arr['ranking'] = $alternatif->pluck('nama')->combine($sum_alt);
            // return dd($arr);

            return $arr;

        } else {
            return null;
        }
    }
    
}
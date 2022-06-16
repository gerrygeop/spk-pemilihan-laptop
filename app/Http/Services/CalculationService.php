<?php

namespace App\Http\Services;

use App\Models\{Kriteria, Representasi, Alternatif, AlternatifMaxBobot, Calculation};
use Illuminate\Support\{Str, Arr};
use App\Http\Traits\CalculationTrait;

class CalculationService
{
    use CalculationTrait;

    public function getRepresentasiWhereHasNilai()
    {
        $representasi = Representasi::whereNotNull('nilai')->get(['keterangan'])->pluck('keterangan');
        return $representasi = $representasi->combine($representasi)->toArray();
    }

    public function getRepresentasiWhereHasMax()
    {
        $representasi = Representasi::orderBy('kriteria_id')->get()
            ->groupBy(function($item) {
                return $item->kriteria_id;
            });

        foreach ($representasi as $key => $value) {
            if ( $value->last()->nilai ) {
                $ktr_max[] = $value->last()->keterangan;
            } else {
                $ktr_max[] = $value->last()->max;
            }
        }

        return $ktr_max;
    }

    public function getAlternatif($kriteria)
    {
        $representasi_has_nilai = $this->getRepresentasiWhereHasNilai();
        $representasi_has_max = $this->getRepresentasiWhereHasMax();

        $ktr_nama_slug = $this->collectionToSlug($kriteria);
        $ktr_nama_slug = $ktr_nama_slug->combine($representasi_has_max);

        foreach ( $ktr_nama_slug as $key => $value ) {
            if ( isset($representasi_has_nilai[$value]) ) {
                $orWhere[] = [$key, '=', $value];
            } else {
                $where[] = [$key, '<=', $value];
            }
        }

        return Alternatif::where($where)->orWhere($orWhere)->get();
    }

    public function calculateAllAlternatif()
    {
        $kriteria = Kriteria::get(['nama', 'keterangan', 'bobot']);
        $alternatif = $this->getAlternatif($kriteria);
        
        if ( $alternatif->isNotEmpty() ) {
            $alternatif_id = $alternatif->pluck('id')->toArray();
            $alternatif_nama = $alternatif->pluck('nama')->toArray();
            $arr = $this->fuzzyCalculations($kriteria, $alternatif_id);
            $alt_values = $this->combineAlternatifValueOfEachKtriteria($arr['kali_bobot_ktr']);
            $sum_alt = $this->sumAlternatifValues($alternatif_nama, $alt_values);

            arsort($sum_alt);
            return $sum_alt;

        } else {
            return null;
        }
    }
}
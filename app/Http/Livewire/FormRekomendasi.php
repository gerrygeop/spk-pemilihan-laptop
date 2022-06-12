<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Arr;
use App\Models\Alternatif;
use App\Models\Kriteria;

class FormRekomendasi extends Component
{
    public $nama_kriteria = [];
    public $kriteria_array = [];

    public function render()
    {
        $kriteria = Kriteria::with('representasi')->get();
        $this->kriteria_array = Kriteria::pluck('kode');

        return view('livewire.form-rekomendasi', [
            'kriteria' => $kriteria,
        ]);
    }

}

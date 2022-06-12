<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function alternatif_max_bobot()
    {
        return $this->hasOne(AlternatifMaxBobot::class);
    }

    public function rekomendasi()
    {
        return $this->hasMany(Rekomendation::class);
    }

    public function removeSlug($text)
    {
        $text = str_replace("_"," ", $text);
        $text = ucfirst($text);
        return $text;
    }

    public function getCurrencyIfCurrency($column)
    {
        if ( $this[$column] == $this->harga ) {
            $this->harga = (int) $this->harga;
            return 'Rp '. number_format($this[$column],2,",",".");
        } else {
            return $this[$column];
        }

    }

}

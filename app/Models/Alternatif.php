<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function removeSlug($text)
    {
        $text = str_replace("_"," ", $text);
        $text = ucfirst($text);
        return $text;
    }

    public function alternatif_max_bobot()
    {
        return $this->hasOne(AlternatifMaxBobot::class);
    }

}

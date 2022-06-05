<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kriteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function representasi()
    {
        return $this->hasMany(Representasi::class);
    }

    public function isChecked($option)
    {
        if ($option == $this->keterangan) {
            return 'checked';
        } else {
            return '';
        }
    }

    public function isSelected($option)
    {
        if ($option == $this->type_inputan) {
            return 'selected';
        } else {
            return '';
        }
    }

    public function toSlug()
    {
        return Str::of($this->nama)->slug('_');
    }
}

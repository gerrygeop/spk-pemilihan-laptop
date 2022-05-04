<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function setUp() {
        parent::setUp();
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
}

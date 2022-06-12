<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Alternatif;
use App\Models\Representasi;

class HomeController extends Controller
{
    public function home()
    {
        $all_alternatif = Alternatif::paginate(10);
        $alternatifColumn = $this->getColumnList();
        $alternatifColumn = Arr::only($alternatifColumn, [4, 5, 6, 7]);
        
        return view('home', compact('all_alternatif', 'alternatifColumn'));
    }

    private function getColumnList()
    {
        $alt = new Alternatif;
        return $alt->getConnection()->getSchemaBuilder()->getColumnListing('alternatifs');
    }
}

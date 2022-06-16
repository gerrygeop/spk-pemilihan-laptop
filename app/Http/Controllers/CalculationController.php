<?php

namespace App\Http\Controllers;

use App\Http\Services\CalculationService;

class CalculationController extends Controller
{
    public function index(CalculationService $service)
    {
        $calculations = $service->calculateAllAlternatif();
        return view('tamu.calculation', compact('calculations'));
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectAuthenticatedUsersController extends Controller
{
    public function home()
    {
        if (auth()->user()->role === 'admiral') {
            return redirect()->route('d.dashboard');
        } else {
            return redirect()->route('home');
        }
        
        return auth()->logout();
    }
}

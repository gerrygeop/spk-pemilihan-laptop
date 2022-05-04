<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectAuthenticatedUsersController extends Controller
{
    public function home()
    {
        if (auth()->user()->role == 'admiral') {
            return redirect()->route('d.dashboard');
        }
        elseif(auth()->user()->role == 'tamu'){
            return redirect()->route('home');
        }
        else{
            return auth()->logout();
        }
    }
}

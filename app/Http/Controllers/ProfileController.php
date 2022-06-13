<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile.profile');
    }

    public function updateUserInformation(Request $request)
    {
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.auth()->user()->id],
        ]);

        auth()->user()->update($valid);

        return back()->with('success_information', 'Berhasil memperbarui informasi profile');
    }

    public function updateUserPassword(Request $request)
    {
        if (Hash::check($request->current_password, auth()->user()->password)) {
            $valid = $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            auth()->user()->update([
                'password' => Hash::make($valid['password']),
            ]);

            return back()->with('success_password', 'Berhasil mengubah password');

        } else {
            return back()->with('wrong_current_password', 'Kata sandi saat ini salah!');
        }
    }
}

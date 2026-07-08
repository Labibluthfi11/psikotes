<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KandidatController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function showLogin()
    {
        return view('kandidat.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('kandidat')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/instruksi');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('kandidat')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function instruksi()
    {
        return view('kandidat.instruksi');
    }
}

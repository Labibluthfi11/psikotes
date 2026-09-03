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
        $request->validate([
            'nama' => 'required|string',
            'pin' => 'required|string',
        ]);

        $kandidat = \App\Models\Kandidat::where('nama', $request->nama)
                                        ->where('pin', $request->pin)
                                        ->first();

        if ($kandidat) {
            Auth::guard('kandidat')->login($kandidat);
            $request->session()->regenerate();
            return redirect('/instruksi');
        }

        return back()->withErrors([
            'nama' => 'Nama atau PIN salah.',
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

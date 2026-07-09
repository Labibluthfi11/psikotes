<?php

namespace App\Http\Controllers;

use App\Models\HasilTes;
use App\Services\TesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TesController extends Controller
{
    protected $tesService;

    public function __construct(TesService $tesService)
    {
        $this->tesService = $tesService;
    }

    public static function middleware(): array
    {
        return ['auth:kandidat'];
    }

    // ===================== SHOW FORM =====================
    public function showForm()
    {
        $kandidat    = Auth::guard('kandidat')->user();
        $soalBigFive = $this->tesService->getSoalBigFive();
        $soalLogika  = $this->tesService->getSoalLogika();

        return view('tes.form', compact('soalBigFive', 'soalLogika', 'kandidat'));
    }

    // ===================== SUBMIT & HITUNG SKOR =====================
    public function submit(Request $request)
    {
        $soalBigFive = $this->tesService->getSoalBigFive();
        $soalLogika  = $this->tesService->getSoalLogika();

        // Validasi semua soal wajib diisi
        $rules = [];
        foreach (range(0, count($soalBigFive) - 1) as $i) {
            $rules["bf_{$i}"] = 'required|integer|min:1|max:5';
        }
        foreach (range(0, count($soalLogika) - 1) as $i) {
            $rules["lg_{$i}"] = 'required|string';
        }
        $request->validate($rules);

        // Ambil hanya input yang diizinkan untuk keamanan
        $allowedKeys = array_keys($rules);
        $inputData = $request->only($allowedKeys);

        // Proses skor dan simpan via Service
        $this->tesService->hitungDanSimpanHasil($inputData);

        return redirect('/tes/selesai');
    }

    // ===================== HALAMAN HASIL =====================
    public function hasil($id)
    {
        if (!auth()->guard('web')->check()) {
            abort(403, 'Unauthorized');
        }

        $hasil = HasilTes::findOrFail($id);
        return view('tes.hasil', compact('hasil'));
    }
}

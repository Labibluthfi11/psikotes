<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kandidat;

class UjianController extends Controller
{
    // ADMIN: Set status global
    public function updateGlobalStatus(Request $request)
    {
        $status = $request->input('status'); // 'running', 'paused', 'idle'
        
        $settings = DB::table('ujian_settings')->first();
        
        if (!$settings) {
            DB::table('ujian_settings')->insert([
                'status_ujian_global' => $status,
                'waktu_mulai_global' => ($status === 'running') ? now() : null,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            DB::table('ujian_settings')->update([
                'status_ujian_global' => $status,
                'waktu_mulai_global' => ($status === 'running' && !$settings->waktu_mulai_global) ? now() : $settings->waktu_mulai_global,
                'updated_at' => now()
            ]);
        }

        return response()->json(['message' => 'Status ujian diperbarui ke: ' . $status]);
    }

    // KANDIDAT: Mulai tes pribadi
    public function mulaiTesPribadi(Request $request)
    {
        $kandidatId = auth()->id(); // Asumsi pakai auth
        $kandidat = Kandidat::find($kandidatId);
        
        $settings = DB::table('ujian_settings')->first();
        
        if (!$settings || $settings->status_ujian_global !== 'running') {
            return response()->json(['message' => 'Ujian belum dimulai atau sedang dijeda.'], 403);
        }

        // Set status pribadi ke active
        $kandidat->update([
            'status_ujian_pribadi' => 'active',
            'resume_time_pribadi' => now(),
            // Sisa waktu bisa dihitung frontend/backend nantinya
        ]);

        return response()->json(['message' => 'Tes dimulai!']);
    }
}

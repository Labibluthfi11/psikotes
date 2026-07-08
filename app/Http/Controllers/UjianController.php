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
        $durasi = (int)$request->input('durasi', 60);
        
        $settings = DB::table('ujian_settings')->first();
        
        if ($status === 'running') {
            // Jika resumed dari pause
            if ($settings && $settings->sisa_waktu_paused > 0) {
                DB::table('ujian_settings')->update([
                    'status_ujian_global' => 'running',
                    'waktu_berakhir' => now()->addSeconds($settings->sisa_waktu_paused),
                    'sisa_waktu_paused' => 0,
                    'updated_at' => now()
                ]);
            } else {
                // Start baru
                DB::table('ujian_settings')->updateOrInsert(['id' => 1], [
                    'status_ujian_global' => 'running',
                    'durasi_total_menit' => $durasi,
                    'waktu_berakhir' => now()->addMinutes($durasi),
                    'sisa_waktu_paused' => 0,
                    'updated_at' => now(),
                    'created_at' => now()
                ]);
            }
        } elseif ($status === 'paused') {
            // Pause: Simpan sisa waktu
            if ($settings && $settings->waktu_berakhir) {
                $remaining = max(0, \Carbon\Carbon::parse($settings->waktu_berakhir)->diffInSeconds(now()));
                DB::table('ujian_settings')->update([
                    'status_ujian_global' => 'paused',
                    'sisa_waktu_paused' => $remaining,
                    'waktu_berakhir' => null,
                    'updated_at' => now()
                ]);
            }
        } else {
            // Idle
            DB::table('ujian_settings')->update(['status_ujian_global' => 'idle', 'waktu_berakhir' => null, 'sisa_waktu_paused' => 0]);
        }

        return redirect('/admin')->with('success', 'Status ujian diperbarui ke: ' . $status);
    }

    // API: Ambil sisa waktu (untuk polling)
    public function getSisaWaktu()
    {
        $settings = DB::table('ujian_settings')->first();
        if (!$settings) return response()->json(['remaining' => 0, 'status' => 'idle']);

        if ($settings->status_ujian_global === 'running' && $settings->waktu_berakhir) {
            // Hitung selisih dari waktu sekarang ke waktu berakhir
            $remaining = \Carbon\Carbon::now()->diffInSeconds(\Carbon\Carbon::parse($settings->waktu_berakhir), false);
            // diffInSeconds dengan false mengembalikan nilai negatif jika waktu_berakhir sudah lewat
            return response()->json(['remaining' => max(0, $remaining), 'status' => 'running']);
        }

        return response()->json(['remaining' => $settings->sisa_waktu_paused ?? 0, 'status' => $settings->status_ujian_global]);
    }

    // KANDIDAT: Mulai tes pribadi
    public function mulaiTesPribadi(Request $request)
    {
        // Verifikasi otentikasi secara eksplisit
        if (!auth('kandidat')->check()) {
            return redirect()->route('kandidat.login')->with('error', 'Sesi anda telah berakhir, silakan login kembali.');
        }

        $kandidat = auth('kandidat')->user();
        
        $settings = DB::table('ujian_settings')->first();
        
        if (!$settings || $settings->status_ujian_global !== 'running') {
            return back()->with('error', 'Ujian belum dimulai atau sedang dijeda oleh admin.');
        }

        // Cek apakah waktu sudah habis menggunakan waktu_berakhir
        if ($settings->waktu_berakhir && now()->greaterThan(\Carbon\Carbon::parse($settings->waktu_berakhir))) {
            return back()->with('error', 'Waktu sudah habis! Anda tidak bisa mengerjakan soal psikotes lagi. Untuk info lebih lanjut silahkan hubungi HRD PT Ansel Muda Berkarya.');
        }

        // Set status pribadi ke active
        $kandidat->update([
            'status_ujian_pribadi' => 'active',
            'resume_time_pribadi' => now(),
        ]);

        return redirect('/tes');
    }
}

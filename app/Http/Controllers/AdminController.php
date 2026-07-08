<?php

namespace App\Http\Controllers;

use App\Models\HasilTes;
use App\Models\Kandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Define the middleware for the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth:web' => ['except' => ['login', 'loginPost']],
        ];
    }

    /**
     * Show the login form.
     */
    public function login()
    {
        if (Auth::guard('web')->check()) {
            return redirect('/admin');
        }
        return view('admin.login');
    }

    /**
     * Handle the login request.
     */
    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/admin');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Handle the logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    /**
     * List all test results with search functionality and dashboard metrics.
     */
    public function index(Request $request)
    {
        $query = HasilTes::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $hasilTes = $query->latest()->paginate(10);

        // Aggregated data for charts
        $stats = [
            'total' => HasilTes::count(),
            'avg_logika' => round(HasilTes::avg('skor_logika'), 1),
            'big_five' => [
                'O' => HasilTes::avg('skor_o'),
                'C' => HasilTes::avg('skor_c'),
                'E' => HasilTes::avg('skor_e'),
                'A' => HasilTes::avg('skor_a'),
                'N' => HasilTes::avg('skor_n'),
            ],
            'logika_dist' => [
                'Kurang' => HasilTes::where('kat_logika', 'Kurang')->count(),
                'Cukup' => HasilTes::where('kat_logika', 'Cukup')->count(),
                'Baik' => HasilTes::where('kat_logika', 'Baik')->count(),
            ]
        ];

        return view('admin.index', compact('hasilTes', 'stats'));
    }

    /**
     * Show details of a single candidate result.
     */
    public function show($id)
    {
        $hasil = HasilTes::findOrFail($id);
        return view('admin.show', compact('hasil'));
    }

    public function destroy($id)
    {
        HasilTes::findOrFail($id)->delete();
        return redirect('/admin')->with('success', 'Data hasil tes berhasil dihapus.');
    }

    // --- Manajemen Kandidat ---

    public function kandidatIndex()
    {
        $kandidat = Kandidat::all();
        return view('admin.kandidat.index', compact('kandidat'));
    }

    public function kandidatCreate()
    {
        return view('admin.kandidat.create');
    }

    public function kandidatStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:kandidat,email',
            'password' => 'required|string|min:6',
            'posisi' => 'required|string|max:255',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        
        Kandidat::create($validated);

        return redirect('/admin/kandidat')->with('success', 'Kandidat berhasil ditambahkan.');
    }

    public function kandidatImport(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $content = file_get_contents($file->getPathname());
        $delimiter = (strpos($content, ';') !== false) ? ';' : ',';

        $handle = fopen($file->getPathname(), 'r');
        fgetcsv($handle, 0, $delimiter);

        $now = now();
        $importedData = [];

        while (($data = fgetcsv($handle, 0, $delimiter)) !== FALSE) {
            if (empty($data[0])) { continue; }

            $nama = $data[0];
            $posisi = $data[1] ?? 'Umum'; 
            
            $email = strtolower(str_replace(' ', '.', $nama)) . '_' . rand(100, 999) . '@tes.com';
            $password = 'kandidat' . rand(1000, 9999);
            
            Kandidat::create([
                'nama' => $nama,
                'email' => $email,
                'password' => Hash::make($password),
                'posisi' => $posisi,
            ]);

            \Log::info('Attempting to create KandidatImport: ' . $nama);
            $import = \App\Models\KandidatImport::create([
                'nama' => $nama,
                'email' => $email,
                'password' => $password,
                'posisi' => $posisi,
                'imported_at' => $now,
            ]);
            \Log::info('Created KandidatImport ID: ' . $import->id);

            $importedData[] = [
                'nama' => $nama,
                'email' => $email,
                'password' => $password,
                'posisi' => $posisi,
            ];
        }
        fclose($handle);

        return view('admin.kandidat.import-result', ['kandidatBaru' => $importedData]);
    }

    public function showAllImportHistory()
    {
        $imports = \App\Models\KandidatImport::latest('imported_at')->get();
        return view('admin.kandidat.import-history', compact('imports'));
    }

    public function kandidatDelete($id)
    {
        $kandidat = Kandidat::findOrFail($id);
        $kandidat->delete();

        return redirect('/admin/kandidat')->with('success', 'Kandidat berhasil dihapus.');
    }
}

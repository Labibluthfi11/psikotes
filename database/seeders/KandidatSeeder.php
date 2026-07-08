<?php

namespace Database\Seeders;

use App\Models\Kandidat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kandidat::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi@test.com',
            'password' => Hash::make('test123'),
            'posisi' => 'Staff QC',
            'sudah_tes' => false,
        ]);
    }
}

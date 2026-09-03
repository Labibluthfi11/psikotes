<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kandidat;

class GeneratePin extends Command
{
    protected $signature = 'kandidat:generate-pin';
    protected $description = 'Generate PIN for candidates who do not have one';

    public function handle()
    {
        $kandidatList = Kandidat::whereNull('pin')->get();

        if ($kandidatList->isEmpty()) {
            $this->info('Semua kandidat sudah memiliki PIN.');
            return;
        }

        foreach ($kandidatList as $kandidat) {
            $pin = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $kandidat->update(['pin' => $pin]);
            $this->line("{$kandidat->nama}: {$pin}");
        }

        $this->info('Berhasil meng-generate PIN untuk kandidat lama.');
    }
}

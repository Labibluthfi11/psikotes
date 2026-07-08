<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilTes extends Model
{
    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'hasil_tes';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'posisi',
        'tanggal',
        'skor_o',
        'skor_c',
        'skor_e',
        'skor_a',
        'skor_n',
        'skor_logika',
        'kat_o',
        'kat_c',
        'kat_e',
        'kat_a',
        'kat_n',
        'kat_logika',
        'desk_o',
        'desk_c',
        'desk_e',
        'desk_a',
        'desk_n',
        'jawaban_detail',
    ];

    /**
     * Casting tipe atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal' => 'date',
        'skor_o' => 'integer',
        'skor_c' => 'integer',
        'skor_e' => 'integer',
        'skor_a' => 'integer',
        'skor_n' => 'integer',
        'skor_logika' => 'integer',
        'jawaban_detail' => 'array',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kandidat extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'kandidat';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'posisi',
        'sudah_tes',
        'status_ujian_pribadi',
        'resume_time_pribadi',
        'sisa_waktu_detik',
    ];

    protected $hidden = [
        'password',
    ];
}

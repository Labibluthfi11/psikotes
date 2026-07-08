<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KandidatImport extends Model
{
    protected $table = 'kandidat_imports';
    protected $fillable = ['nama', 'email', 'password', 'posisi', 'imported_at'];
}

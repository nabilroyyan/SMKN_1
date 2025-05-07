<?php

namespace App\Models;

use App\Models\Pelanggaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skor_Pelanggaran extends Model
{
    protected $table = 'skor_pelanggaran';

    protected $fillable = [
        'nama_pelanggaran',
        'skor',
        'jenis_pelanggaran',
    ];

}

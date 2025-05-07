<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Tindakan extends Model
{
    protected $table = 'tindakan';

    protected $fillable = [
        'id_siswa',
        'tindakan',
        'catatan',
        'status_tindakan', 
        'catatan_tindakan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

   

    // Tentukan kolom yang boleh diubah
   

}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_guru',
        'matpel',
        'status',
    ];

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id_guru');
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}



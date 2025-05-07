<?php

namespace App\Models;

use App\Models\Guru;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'jurusan',
        'tinkat',
        'id_guru',
        'id_users',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }


    public function siswas()
    {
        return $this->belongsToMany(Siswa::class, 'kelas_siswa', 'kelas_id', 'siswa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }


    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
}

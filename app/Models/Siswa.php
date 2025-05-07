<?php

namespace App\Models;

use app\Models\Guru;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Pelanggaran;

class Siswa extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural of the model name
    protected $table = 'siswa';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'nama_siswa',
        'nisn',
        'tempat',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_dalam_keluarga',
        'anak_ke',
        'alamat_peserta_didik',
        'nomer_telepon_rumah',
        'sekolah_asal',
        'diterima_disekolah_pada_tanggal',
        'nama_ayah',
        'nama_ibu',
        'alamat_orangtua',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'foto_siswa',
    ];

    // Specify the attributes that should be hidden for arrays
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

        public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_siswa', 'siswa_id', 'kelas_id');
    }
    
        public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'id_siswa');
    }

        public function tindakan()
    {
        return $this->hasOne(Tindakan::class, 'id_siswa', 'id');
    }

        public function getSudahDitindakAttribute()
    {
        return $this->tindakan()->exists();
    }   

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_siswa');
    }
    
  
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Skor_pelanggaran;

class Pelanggaran extends Model
{
    protected $table = 'pelanggaran';

    protected $fillable = [
        'ket_pelanggaran',
        'bukti_pelanggaran',
        'tanggal',
        'id_siswa',
        'id_users',
        'id_skor_pelanggaran',
    ];

    /**
     * Relasi ke model Siswa.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    /**
     * Relasi ke model User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    /**
     * Relasi ke model SkorPelanggaran.
     */
    public function skor_pelanggaran(): BelongsTo
    {
        return $this->belongsTo(Skor_Pelanggaran::class, 'id_skor_pelanggaran');
    }

    

}

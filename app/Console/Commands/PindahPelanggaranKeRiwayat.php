<?php

namespace App\Console\Commands;

use App\Models\Pelanggaran;
use Illuminate\Console\Command;

class PindahPelanggaranKeRiwayat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:pindah-pelanggaran-ke-riwayat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredPelanggaran = Pelanggaran::where('tanggal', '<', now()->subDay())->get();
    
        foreach ($expiredPelanggaran as $item) {
            \App\Models\RiwayatPelanggaran::create([
                'id_siswa' => $item->id_siswa,
                'id_users' => $item->id_users,
                'id_skor_pelanggaran' => $item->id_skor_pelanggaran,
                'ket_pelanggaran' => $item->ket_pelanggaran,
                'bukti_pelanggaran' => $item->bukti_pelanggaran,
                'tanggal' => $item->tanggal,
            ]);
    
            $item->delete(); // hapus dari tabel utama
        }
    
        $this->info('Pelanggaran lama berhasil dipindahkan ke riwayat.');
    }
    
}

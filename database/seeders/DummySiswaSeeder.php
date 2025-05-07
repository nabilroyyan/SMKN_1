<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DummySiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('siswa')->insert([
            [
                'nama_siswa' => 'Ahmad Fauzi',
                'nisn' => '1234567890',
                'tempat' => 'Sumenep',
                'tanggal_lahir' => '2005-05-15',
                'jenis_kelamin' => 'L',
                'agama' => 'Islam',
                'status_dalam_keluarga' => 'Anak Kandung',
                'anak_ke' => 1,
                'alamat_peserta_didik' => 'Jl. Merdeka No. 10, Sumenep',
                'nomer_telepon_rumah' => '081234567890',
                'sekolah_asal' => 'SMP Negeri 1 Sumenep',
                'diterima_disekolah_pada_tanggal' => '2021-07-15',
                'nama_ayah' => 'Budi Santoso',
                'nama_ibu' => 'Siti Aminah',
                'alamat_orangtua' => 'Jl. Merdeka No. 10, Sumenep',
                'pekerjaan_ayah' => 'Petani',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'foto_siswa' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_siswa' => 'Siti Nurhaliza',
                'nisn' => '1234567891',
                'tempat' => 'Pamekasan',
                'tanggal_lahir' => '2006-03-20',
                'jenis_kelamin' => 'P',
                'agama' => 'Islam',
                'status_dalam_keluarga' => 'Anak Kandung',
                'anak_ke' => 2,
                'alamat_peserta_didik' => 'Jl. Raya No. 5, Pamekasan',
                'nomer_telepon_rumah' => '081234567891',
                'sekolah_asal' => 'SMP Negeri 2 Pamekasan',
                'diterima_disekolah_pada_tanggal' => '2021-07-15',
                'nama_ayah' => 'Ahmad Yani',
                'nama_ibu' => 'Fatimah',
                'alamat_orangtua' => 'Jl. Raya No. 5, Pamekasan',
                'pekerjaan_ayah' => 'Pedagang',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'foto_siswa' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_siswa' => 'Rizky Maulana',
                'nisn' => '1234567892',
                'tempat' => 'Bangkalan',
                'tanggal_lahir' => '2005-12-10',
                'jenis_kelamin' => 'L',
                'agama' => 'Islam',
                'status_dalam_keluarga' => 'Anak Kandung',
                'anak_ke' => 3,
                'alamat_peserta_didik' => 'Jl. Kebun No. 8, Bangkalan',
                'nomer_telepon_rumah' => '081234567892',
                'sekolah_asal' => 'SMP Negeri 3 Bangkalan',
                'diterima_disekolah_pada_tanggal' => '2021-07-15',
                'nama_ayah' => 'Slamet Riyadi',
                'nama_ibu' => 'Kartini',
                'alamat_orangtua' => 'Jl. Kebun No. 8, Bangkalan',
                'pekerjaan_ayah' => 'Nelayan',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'foto_siswa' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
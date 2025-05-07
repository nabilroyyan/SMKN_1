<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyGuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guru')->insert([
            [
                'nama_guru' => 'Ahmad Fauzi',
                'matpel' => 'Matematika',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_guru' => 'Siti Aminah',
                'matpel' => 'Bahasa Inggris',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_guru' => 'Budi Santoso',
                'matpel' => 'Fisika',
                'status' => 'tidak aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
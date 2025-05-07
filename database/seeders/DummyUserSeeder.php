<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
        [
            'name'=>'superadmin',
            'email'=>'superadmin@gmail.com',
            'role'=>'superadmin',
            'password'=>bcrypt('12345'),
        ],
        [
            'name'=>'wakel',
            'email'=>'wakel@gmail.com',
            'role'=>'wakel',
            'password'=>bcrypt('12345'),
        ],
        [
            'name'=>'sekretaris_kelas',
            'email'=>'sekretaris_kelas@gmail.com',
            'role'=>'sekretaris_kelas',
            'password'=>bcrypt('12345'),
        ],
        [
            'name'=>'bk',
            'email'=>'bk@gmail.com',
            'role'=>'bk',
            'password'=>bcrypt('12345'),
        ],
        [
            'name'=>'tatip',
            'email'=>'tatip@gmail.com',
            'role'=>'tatip',
            'password'=>bcrypt('12345'),
        ],
        [
            'name'=>'siswa',
            'email'=>'siswa@gmail.com',
            'role'=>'siswa',
            'password'=>bcrypt('12345'),
        ],
    ];

    foreach($userData as $key => $val){
        User::create($val);
    }

    }
}

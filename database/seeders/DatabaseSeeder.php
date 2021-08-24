<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('user_roles')->insert([
            ['nama_role' => 'administrator', "keterangan_role"=>"admin utama"],
            ['nama_role' => 'admin_fakultas', "keterangan_role"=>"admin untuk mengelola anggaran fakultas"]
        ]);
        DB::table('master_tahun_anggarans')->insert([
            ['tahun_anggaran' => 2021, "tahun_anggaran_sebutan"=>"Tahun Anggaran 2021"]
        ]);
        DB::table('master_fakultas')->insert([
            ['fakultas_nama' => "Tarbiyah dan Ilmu Keguruan", "singkatan"=>"FATIK"],
            ['fakultas_nama' => "Syariah", "singkatan"=>"FAKSYA"],
            ['fakultas_nama' => "Ushuluddin, Adab dan Dakwah", "singkatan"=>"FUAD"],
            ['fakultas_nama' => "Ekonomi dan Bisnis Islam", "singkatan"=>"FEBI"],
        ]);
        $user = [
            [
                'user_role_id' => 1,
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('1234qwer'),
            ],
            [
                'user_role_id' => 2,
                'name' => 'febi',
                'email' => 'admin2@mail.com',
                'password' => bcrypt('1234qwer'),
            ],
        ];
        DB::table('users')->insert($user);
        DB::table('user_fakultas')->insert([
            ['user_id' => 2,'idpeg' => 97, "master_fakultas_id"=>4]
        ]);
    }
}
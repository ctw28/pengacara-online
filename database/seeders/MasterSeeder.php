<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('m_kegiatan_jabatans')->insert([
            ['kegiatan_jabatan_nama' => 'Peserta','kegiatan_jabatan_keterangan'=>'ket'],
            ['kegiatan_jabatan_nama' => 'Narasumber','kegiatan_jabatan_keterangan'=>'ket']
        ]);
        
        DB::table('m_bayar_kategoris')->insert([
            ['bayar_nama' => 'Uang Saku','is_pajak'=>"1"],
            ['bayar_nama' => 'Transport','is_pajak'=>"0"],
            ['bayar_nama' => 'Honorium','is_pajak'=>"1"]
        ]);
        DB::table('master_satuans')->insert([
            ['master_satuan_nama' => 'Hari','master_satuan_singkatan'=>"Hari"],
            ['master_satuan_nama' => 'Kegiatan','master_satuan_singkatan'=>"Keg"],
            ['master_satuan_nama' => 'Orang Jam','master_satuan_singkatan'=>"OJ"],
            ['master_satuan_nama' => 'Orang Hari','master_satuan_singkatan'=>"OH"],
        ]);

    }
}
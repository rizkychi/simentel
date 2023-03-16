<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WKecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wil_kecamatan')->insertOrIgnore([
            ['id' => 1, 'kabupaten_id' => 5, 'kecamatan_kode' => '01', 'kecamatan' => 'Danurejan'],
            ['id' => 2, 'kabupaten_id' => 5, 'kecamatan_kode' => '02', 'kecamatan' => 'Gedongtengen'],
            ['id' => 3, 'kabupaten_id' => 5, 'kecamatan_kode' => '03', 'kecamatan' => 'Gondokusuman'],
            ['id' => 4, 'kabupaten_id' => 5, 'kecamatan_kode' => '04', 'kecamatan' => 'Gondomanan'],
            ['id' => 5, 'kabupaten_id' => 5, 'kecamatan_kode' => '05', 'kecamatan' => 'Jetis'],
            ['id' => 6, 'kabupaten_id' => 5, 'kecamatan_kode' => '06', 'kecamatan' => 'Kotagede'],
            ['id' => 7, 'kabupaten_id' => 5, 'kecamatan_kode' => '07', 'kecamatan' => 'Kraton'],
            ['id' => 8, 'kabupaten_id' => 5, 'kecamatan_kode' => '08', 'kecamatan' => 'Mantrijeron'],
            ['id' => 9, 'kabupaten_id' => 5, 'kecamatan_kode' => '09', 'kecamatan' => 'Mergangsan'],
            ['id' => 10, 'kabupaten_id' => 5, 'kecamatan_kode' => '10', 'kecamatan' => 'Ngampilan'],
            ['id' => 11, 'kabupaten_id' => 5, 'kecamatan_kode' => '11', 'kecamatan' => 'Pakualaman'],
            ['id' => 12, 'kabupaten_id' => 5, 'kecamatan_kode' => '12', 'kecamatan' => 'Tegalrejo'],
            ['id' => 13, 'kabupaten_id' => 5, 'kecamatan_kode' => '13', 'kecamatan' => 'Umbulharjo'],
            ['id' => 14, 'kabupaten_id' => 5, 'kecamatan_kode' => '14', 'kecamatan' => 'Wirobrajan'],
        ]);
    }
}

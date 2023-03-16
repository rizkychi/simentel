<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WKabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wil_kabupaten')->insertOrIgnore([
            ['id' => 1, 'kabupaten_kode' => '3404', 'kabupaten' => 'Sleman'],
            ['id' => 2, 'kabupaten_kode' => '3402', 'kabupaten' => 'Bantul'],
            ['id' => 3, 'kabupaten_kode' => '3403', 'kabupaten' => 'Gunung Kidul'],
            ['id' => 4, 'kabupaten_kode' => '3401', 'kabupaten' => 'Kulon Progo'],
            ['id' => 5, 'kabupaten_kode' => '3471', 'kabupaten' => 'Kota Yogyakarta'],
        ]);
    }
}

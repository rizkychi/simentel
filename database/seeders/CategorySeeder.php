<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insertOrIgnore([
            ['id' => 1, 'category' => 'Menara Mandiri Greenfield'],
            ['id' => 2, 'category' => 'Menara Mandiri Rooftop'],
            ['id' => 3, 'category' => 'Menara Teregang'],
            ['id' => 4, 'category' => 'Menara Tunggal'],
            ['id' => 5, 'category' => 'Tiang Microcell'],
        ]);
    }
}

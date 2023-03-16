<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insertOrIgnore([
            ['id' => 1, 'role' => 'admin'],
            ['id' => 2, 'role' => 'operator'],
            ['id' => 3, 'role' => 'publik']
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dummy admin
        DB::table('users')->insert([
            ['username' => 'admin', 'user' => 'Admin', 'password' => bcrypt('admin'), 'email' => 'admin@admin.com', 'roles_id' => 1],
            ['username' => 'operator', 'user' => 'Operator', 'password' => bcrypt('operator'), 'email' => 'operator@operator.com', 'roles_id' => 2],
            ['username' => 'publik', 'user' => 'Publik', 'password' => bcrypt('publik'), 'email' => 'publik@publik.com', 'roles_id' => 3],
        ]);
    }
}

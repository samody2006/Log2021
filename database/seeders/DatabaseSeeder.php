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
        DB::table('users')->insert([
             
                'fullname'          => 'Admin',
                'email'         => 'admin@admin.com',
                'password'      => bcrypt('123456'),
                'created_at'    => date("Y-m-d H:i:s")
            ]);
        }
}

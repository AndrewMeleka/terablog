<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Andrew Meleka',
            'email' => 'andrew-nageh@hotmail.com',
            'password'=> bcrypt('andrewnageh')
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Run AdminUserSeeder which add default Admin User to DB
        $this->call(AdminUserSeeder::class); 
    }
}

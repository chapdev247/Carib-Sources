<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Superadmin

        DB::table('users')->insert([
            'f_name' => 'Super',
            'l_name' => 'Admin',
            'email' => 'superadmin@carib.com',
            'mobile' => '9876543210',
            'password' => bcrypt('secret'),
        ]);

    }
}

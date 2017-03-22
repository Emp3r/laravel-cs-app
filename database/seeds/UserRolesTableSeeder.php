<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            'name' => 'Běžný',
        ]);

        DB::table('user_roles')->insert([
            'name' => 'Pokročilý',
        ]);

        DB::table('user_roles')->insert([
            'name' => 'Admin',
        ]);

    }
}

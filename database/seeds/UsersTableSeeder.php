<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'a@a.a',
            'name' => 'admin',
            'slug' => 'admin',
            'password' => bcrypt('root'),
        ]);

        DB::table('users')->insert([
            'email' => '1@a.a',
            'name' => '1',
            'slug' => '1',
            'verified' => '1',
            'password' => bcrypt('ahojoj'),
        ]);

    }
}

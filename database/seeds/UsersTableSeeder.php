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
            'email' => 'admin@'.str_replace(['.', ','], '', strtolower(config('app.name'))).'.cz',
            'name' => 'Page Admin',
            'slug' => 'admin',
            'verified' => true,
            'role_id' => 3,
            'password' => bcrypt('root'),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ]);

        factory('App\User', 2)->create();


    }
}

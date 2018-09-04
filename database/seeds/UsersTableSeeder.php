<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@sssss.com',
            'password' => bcrypt('123qweP'),
            'root' => 1,
            'api_token'=>"",
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'User',
            'email' => 'user@ssa.com',
            'password' => bcrypt('123qweP'),
            'api_token'=>"",
        ]);
    }
}

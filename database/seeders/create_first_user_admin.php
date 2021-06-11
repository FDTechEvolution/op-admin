<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class create_first_user_admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'watcharin',
            'lastname' => 'khyokaj',
            'username' => 'nauthiz',
            'password' => Hash::make('19112531'),
            'phone' => '0892666756',
            'line' => 'nauthiz.rinz',
            'is_active' => 'Y',
            'is_admin' => 'Y',
            'status' => 'CO'
        ]);
    }
}

<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert(
            'insert into users (username,email,password,address,created_at) values (?, ?, ?, ?, ?)',
            [
                'Sunethjoes',
                'sunethjoes@gmail.com',
                Hash::make('abcd1234'),
                '47, James St, Collingwood, Vic',
                new DateTime()
            ]
        );
    }
}

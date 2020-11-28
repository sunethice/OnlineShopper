<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::insert(
            'insert into products (name,description,color,weight,price,cost,stock,imageurl,created_at,updated_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                'Sleeveless Textured Tiered Maxi Dress',
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'Kumquat,black',
                1.20,
                25.00,
                10.00,
                25,
                'Product01.jpg',
                new DateTime(),
                null
            ]);
        DB::insert(
            'insert into products (name,description,color,weight,price,cost,stock,imageurl,created_at,updated_at) values (?, ?, ?, ?, ?, ?, ?, ?. ?)',
            [
                'Short Sleeve Notch Neck Top',
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'Indigo Ink,Snow White,W. Fuchsia',
                1.50,
                15.99,
                5.99,
                25,
                'Product02.jpg',
                new DateTime(),
                null
            ]);
    }
}

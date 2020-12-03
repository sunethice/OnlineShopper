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
            'insert into products (name,description,color,weight,price,cost,stock,imageurl,created_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                'Sleeveless Textured Tiered Maxi Dress',
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'Kumquat,black',
                1.20,
                25.00,
                10.00,
                25,
                'Product01.jpg',
                new DateTime()
            ]);
        DB::insert(
            'insert into products (name,description,color,weight,price,cost,stock,imageurl,created_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                'Short Sleeve Notch Neck Top',
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'Indigo Ink,Snow White,W. Fuchsia',
                1.50,
                15.99,
                5.99,
                25,
                'Product02.jpg',
                new DateTime()
            ]);
        DB::insert(
            'insert into products (name,description,color,weight,price,cost,stock,imageurl,created_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                'Sleeveless Textured Tiered Maxi Dress',
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'Kumquat,black',
                1.45,
                35.00,
                17.00,
                40,
                'Product01.jpg',
                new DateTime()
            ]);
        DB::insert(
            'insert into products (name,description,color,weight,price,cost,stock,imageurl,created_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                'Sleeveless Textured Tiered Maxi Dress',
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'Kumquat,black',
                1.20,
                25.00,
                10.00,
                25,
                'Product02.jpg',
                new DateTime()
            ]);
        DB::insert(
            'insert into products (name,description,color,weight,price,cost,stock,imageurl,created_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                'Stripe Web Pin Buckle Belt',
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'Navy,white',
                0.50,
                15.00,
                07.00,
                20,
                'Product03.jpg',
                new DateTime()
            ]);
        DB::insert(
            'insert into products (name,description,color,weight,price,cost,stock,imageurl,created_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                'Mens Court Shoes',
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'Navy,Tan',
                2.00,
                20.00,
                10.00,
                15,
                'Product04.jpg',
                new DateTime()
            ]);
        DB::insert(
            'insert into products (name,description,color,weight,price,cost,stock,imageurl,created_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                'Quilted Romper',
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'Oatmeal A',
                1.00,
                10.00,
                06.00,
                18,
                'Product05.jpg',
                new DateTime()
            ]);
        DB::insert(
            'insert into products (name,description,color,weight,price,cost,stock,imageurl,created_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                'Pinafore Dress',
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'Cornsilk',
                1.00,
                15.00,
                08.00,
                25,
                'Product06.jpg',
                new DateTime()
            ]);

    }
}

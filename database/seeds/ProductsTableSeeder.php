<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'product_category_id' => 9, // Outdoors
                'name' => 'Mountain Bike',
                'photo' => null,
                'description' => 'We are offering an all-new species of 29+ mountain bike performance. The wide 3" tires grip relentlessly, amplifying all the benefits of 29ers, while remarkably short chainstays deliver a fun, lively ride.',
                'cost' => 99.99,
                'quantity' => 5
            ],
            [
                'product_category_id' => 1, // Books
                'name' => 'The Great Gatsby by F. Scott Fitzgerald',
                'photo' => null,
                'description' => 'The Great Gatsby is a 1925 novel written by American author F. Scott Fitzgerald that follows a cast of characters living in the fictional towns of West Egg and East Egg on prosperous Long Island in the summer of 1922. The story primarily concerns the young and mysterious millionaire Jay Gatsby and his quixotic passion and obsession with the beautiful former debutante Daisy Buchanan. Considered to be Fitzgerald\'s magnum opus, The Great Gatsby explores themes of decadence, idealism, resistance to change, social upheaval and excess, creating a portrait of the Roaring Twenties that has been described as a cautionary tale regarding the American Dream.',
                'cost' => 9.99,
                'quantity' => 50
            ],
            [
                'product_category_id' => 7, // Tools
                'name' => 'Thor\'s Hammer',
                'photo' => null,
                'description' => 'A handy hammer for when you need a hammer but with a bit of extra bit of power.',
                'cost' => 8.50,
                'quantity' => 1
            ]
        ];

        DB::table('products')->insert($products);
    }
}
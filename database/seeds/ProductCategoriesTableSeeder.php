<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Books',
                'slug' => 'books',
            ],
            [
                'name' => 'Movies',
                'slug' => 'movies',
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
            ],
            [
                'name' => 'Gardening',
                'slug' => 'gardening',
            ],
            [
                'name' => 'Automotive',
                'slug' => 'automotive',
            ],
            [
                'name' => 'Housewears',
                'slug' => 'housewears',
            ],
            [
                'name' => 'Tools',
                'slug' => 'tools',
            ],
            [
                'name' => 'Furniture',
                'slug' => 'furniture',
            ],
            [
                'name' => 'Outdoor',
                'slug' => 'outdoor',
            ],
            [
                'name' => 'Office',
                'slug' => 'office',
            ],
        ];
        
        DB::table('product_categories')->insert($categories);
    }
}
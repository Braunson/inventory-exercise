<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = [
            [
                'product_id' => 1,
                'name' => 'John Doe',
                'message' => 'This is fooBar',
                'created_at' => now()->toDateTimeString()
            ],
            [
                'product_id' => 1,
                'name' => 'Jane Doe',
                'message' => 'This is fizz buzz!!!',
                'created_at' => now()->toDateTimeString()
            ]
        ];

        DB::table('product_comments')->insert($comments);
    }
}
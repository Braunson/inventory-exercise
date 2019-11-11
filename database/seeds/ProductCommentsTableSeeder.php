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
                'email' => 'johndoe@gmail.com',
                'message' => 'This is fooBar',
                'created_at' => now()->toDateTime()
            ],
            [
                'product_id' => 1,
                'name' => 'Jane Doe',
                'email' => 'janedoe@gmail.com',
                'message' => 'This is fizz buzz!!!',
                'created_at' => now()->toDateTime()
            ]
        ];

        DB::table('product_comments')->insert($comments);
    }
}
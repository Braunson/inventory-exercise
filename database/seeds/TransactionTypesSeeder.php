<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Product Payment',
                'slug' => 'payment'
            ],
            [
                'name' => 'Layaway Deposit',
                'slug' => 'deposit'
            ]
        ];

        DB::table('transaction_types')->insert($types);
    }
}
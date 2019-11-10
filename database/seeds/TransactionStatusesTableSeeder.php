<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'name' => 'Successful',
                'slug' => 'successful'
            ],
            [
                'name' => 'Failed',
                'slug' => 'failed'
            ],
            [
                'name' => 'Pending',
                'slug' => 'pending'
            ],
            [
                'name' => 'Refunded',
                'slug' => 'refunded'
            ],
            [
                'name' => 'Cancelled',
                'slug' => 'cancelled'
            ],
            [
                'name' => 'Other',
                'slug' => 'other'
            ],
        ];

        DB::table('transaction_statuses')->insert($statuses);
    }
}
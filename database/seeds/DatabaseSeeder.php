<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ProductCategoriesTableSeeder::class,
            TransactionTypesTableSeeder::class,
            TransactionStatusesTableSeeder::class,
            ProductsTableSeeder::class,
            ProductCommentsTableSeeder::class,
            // TransactionsTableSeeder::class,
            // LayawaysTableSeeder::class,
        ]);
    }
}

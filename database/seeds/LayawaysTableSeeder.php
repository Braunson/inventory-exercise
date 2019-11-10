<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayawaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $layaways = [
            [
                // @TODO
            ]
        ];

        DB::table('layaways')->insert($layaways);
    }
}
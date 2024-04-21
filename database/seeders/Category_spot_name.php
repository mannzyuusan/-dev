<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class Category_spot_name extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            'name' => '居酒屋',
        ]);

        DB::table('categories')->insert([
            'name' => 'グルメ',
        ]);

        DB::table('categories')->insert([
            'name' => 'テーマパーク',
        ]);

        DB::table('categories')->insert([
            'name' => 'ビュースポット',
        ]);
    }
}

?>
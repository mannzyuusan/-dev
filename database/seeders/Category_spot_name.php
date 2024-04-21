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
        DB::table('spots')->insert([
            'name' => '居酒屋',
        ]);

        DB::table('spots')->insert([
            'name' => 'グルメ',
        ]);

        DB::table('spots')->insert([
            'name' => 'テーマパーク',
        ]);

        DB::table('spots')->insert([
            'name' => 'ビュースポット',
        ]);
    }
}

?>
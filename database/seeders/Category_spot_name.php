<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Category_spot_name extends Seeder
{
    public function run()
    {
        DB::table('spots')->insert([
            'name' => '居酒屋',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('spots')->insert([
            'name' => 'グルメ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('spots')->insert([
            'name' => 'テーマパーク',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('spots')->insert([
            'name' => 'ビュースポット',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    
}

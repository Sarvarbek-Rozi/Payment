<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands=[
            ['id'=>'1','user_id'=>'1','name'=>'Artel','photo'=>null],
            ['id'=>'2','user_id'=>'1','name'=>'Ishonch','photo'=>null],
            ['id'=>'3','user_id'=>'1','name'=>'Texnomart','photo'=>null],
            ['id'=>'4','user_id'=>'1','name'=>'Mediapark','photo'=>null],
        ];
        DB::table('brands')->insert($brands);
    }
}

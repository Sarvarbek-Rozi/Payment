<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities=[
          ['id'=>'1','region_id'=>'4','name'=>'Qiziltepa tumani'],
          ['id'=>'2','region_id'=>'4','name'=>'Xatirchi tumani'],
          ['id'=>'3','region_id'=>'4','name'=>'Navbahor tumani'],
          ['id'=>'4','region_id'=>'4','name'=>'Nurota tumani'],
          ['id'=>'5','region_id'=>'4','name'=>'Konimex tumani'],
          ['id'=>'6','region_id'=>'4','name'=>'Uchquduq tumani'],
          ['id'=>'7','region_id'=>'4','name'=>'Zarafshon shahar'],
          ['id'=>'8','region_id'=>'4','name'=>'Tomdi tumani'],
          ['id'=>'9','region_id'=>'10','name'=>'Yunusobod tumani'],
          ['id'=>'10','region_id'=>'10','name'=>'Mirobod tumani'],
          ['id'=>'11','region_id'=>'10','name'=>'Yakkasaroy tumani'],
          ['id'=>'12','region_id'=>'10','name'=>'Olmazor tumani'],
          ['id'=>'13','region_id'=>'10','name'=>'Bektemir tumani'],
          ['id'=>'14','region_id'=>'10','name'=>'Yashnobod tumani'],
          ['id'=>'15','region_id'=>'10','name'=>'Chilonzor tumani'],
        ];
        DB::table('cities')->insert($cities);
    }
}

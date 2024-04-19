<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions=[
            ['id'=>1,'name'=>'Qoraqalpog`iston Respublikasi'],
            ['id'=>2,'name'=>'Buxoro viloyati'],
            ['id'=>3,'name'=>'Samarqand viloyati'],
            ['id'=>4,'name'=>'Navoiy viloyati'],
            ['id'=>5,'name'=>'Andijon viloyati'],
            ['id'=>6,'name'=>'Farg‘ona viloyati'],
            ['id'=>7,'name'=>'Surxondaryo viloyati'],
            ['id'=>8,'name'=>'Sirdaryo viloyati'],
            ['id'=>9,'name'=>'Xorazm viloyati'],
            ['id'=>10,'name'=>'Toshkent viloyati'],
            ['id'=>11,'name'=>'Qashqadaryo viloyati'],
            ['id'=>12,'name'=>'Jizzax viloyati'],
            ['id'=>13,'name'=>'Namangan viloyati']
        ];
        DB::table('regions')->insert($regions);
    }
}

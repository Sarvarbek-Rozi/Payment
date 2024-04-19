<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class   UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user= User::create([
            'name' => 'Sarvarbek Ro`zimurodov',
            'phone' => 942719911,
            'password'=>Hash::make('123456'),
            'status'=> 1,
            'login_last_date'=>Carbon::now()->format('Y-m-d')
        ]);

    }
}

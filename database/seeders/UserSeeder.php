<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' =>"mohammad",
            'email' => "admin@admin.com",
            'password' => Hash::make('123123123'),
            'img' =>'1703715063.png',
            'isAdmin'=>1,
        ]);
    }
}

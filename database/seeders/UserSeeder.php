<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'Marwaali',
            'email' => 'marwa@example',
            'first_name' => 'marwa' ,
            'last_name' => 'ali' ,
            'is_admin' => 0,
            'is_active' => 1 ,
            'password' =>Hash::make('passwordmarwa'),
        ]);

        DB::table('users')->insert([
            'username' => 'alaaisam',
           'email' => 'alaa@gmail',
            'first_name' => 'alaa' ,
            'last_name' => 'isam' ,
            'is_admin' => 1 ,
            'is_active' => 0 ,
            'password' =>Hash::make('passwordalaa'),
        ]);

        DB::table('users')->insert([
            'username' => 'abodahmed',
            'email' => 'abd@example',
            'first_name' => 'abd' ,
            'last_name' => 'ahmed' ,
            'is_admin' => 0 ,
            'is_active' => 0 ,
            'password' =>Hash::make('abd12345'),
        ]);

        DB::table('users')->insert([
            'username' => 'ahmedmahmoud',
            'email' => 'mahmoud@example',
            'first_name' => 'ahmed' ,
            'last_name' => 'mahmoud' ,
            'is_admin' => 1 ,
            'is_active' => 1 ,
            'password' =>Hash::make('ahmed123#@!'),
        ]);

    }
}

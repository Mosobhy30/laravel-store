<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mohamed Sobhy',
            'email' => 'ms@gmail.com',
            'password' => Hash::make('12345678'),
            'phone_number' => '01095657685'
        ]);
        // if no model :
        DB::table('users')->insert([
            'name' => 'Ahmed Sobhy',
            'email' => 'as@gmail.com',
            'password' => Hash::make('12345678'),
            'phone_number' => '0123456789'
        ]);
    }
}

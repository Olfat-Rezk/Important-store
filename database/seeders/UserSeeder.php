<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'name'=>'olfat',
            'email'=>'olfat@gmail.com',
            'password'=>Hash::make('password'),
            'phone'=>'12345678'
        ]);
        DB::table('users')->insert([
            'name'=>'olfat',
            'email'=>'olfatt@gmail.com',
            'password'=>Hash::make('password'),
            'phone'=>'123456678'

        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


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
            'first_name' => Str::random(5),
            'last_name' => Str::random(5),
            'email' => 'admin@gmail.com',
            'contact' => 898793479,
            'password' => 'admin',
            'role' => 'admin',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name'=> "Super",
            'last_name'=> 'Admin',
            'email' => "super@billing.com",
            'password' => "123@Super#"
        ]);
    }
}

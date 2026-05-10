<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;  
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@elektroshop.sk'],
            [
                'name'     => 'Admin',
                'username' => 'admin',
                'email'    => 'admin@elektroshop.sk',
                'password' => Hash::make('WTECH2026'),
                'is_admin' => true,
            ]
        );
    }
}
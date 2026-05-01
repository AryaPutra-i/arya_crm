<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Manager Fabian',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('manager123'),
            'role' => 'manager'
        ]);

        User::create([
            'name' => 'budi sales',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('budisales123'),
            'role' => 'sales'
        ]);

        User::create([
            'name' => 'angga sales',
            'email' => 'angga@gmail.com',
            'password' => Hash::make('anggasales123'),
            'role' => 'sales'
        ]);

       
    }
}

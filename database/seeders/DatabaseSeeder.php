<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $roles = [
            [
                'name' => 'Super Admin',
            ],
            [
                'name' => 'Manager',
            ],
            [
                'name' => 'User',
            ]
        ];
        foreach ($roles as $value) {
            Role::create($value);
        }

        $services  = [
            [
                'name' => 'D~NET Flex',
                'price' => 10000,
            ],
            [
                'name' => 'D~NET Premium',
                'price' => 20000,
            ],
            [
                'name' => 'D~NET Corporate',
                'price' => 30000,
            ],
            [
                'name' => 'D~NET IIX',
                'price' => 40000,
            ],
            [
                'name' => 'D~NET Loop',
                'price' => 50000,
            ],
        ];
        foreach ($services as $value){
            Service::create($value);
        }

        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345678'),
                'role_id' => Role::where('name', 'Super Admin')->first()->id,
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@example.com',
                'password' => Hash::make('12345678'),
                'role_id' => Role::where('name', 'Manager')->first()->id,
            ],
            [
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => Hash::make('12345678'),
                'role_id' => Role::where('name', 'User')->first()->id,
            ]
        ];
        
        foreach ($users as $value){
            User::create($value);
        }
    }
}

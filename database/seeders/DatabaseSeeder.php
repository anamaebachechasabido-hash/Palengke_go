<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database with one demo account per role, so
     * role-based access control can be tested right away.
     *
     * Password for every demo account: password
     */
    public function run(): void
    {
        $accounts = [
            ['name' => 'Ana Admin', 'email' => 'admin@palengke.go', 'role' => User::ROLE_ADMIN],
            ['name' => 'Vic Vendor', 'email' => 'vendor@palengke.go', 'role' => User::ROLE_VENDOR],
            ['name' => 'Carlo Customer', 'email' => 'customer@palengke.go', 'role' => User::ROLE_CUSTOMER],
            ['name' => 'Dara Delivery', 'email' => 'delivery@palengke.go', 'role' => User::ROLE_DELIVERY],
        ];

        foreach ($accounts as $account) {
            User::updateOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'role' => $account['role'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}

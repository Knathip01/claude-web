<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ExportShopSeeder::class);

        // Admin user (ถ้ายังไม่มี)
        if (!User::where('email', 'admin@luxebottles.com')->exists()) {
            User::create([
                'name'     => 'Administrator',
                'email'    => 'admin@luxebottles.com',
                'password' => \Illuminate\Support\Facades\Hash::make('admin1234'),
                'is_admin' => true,
                'is_member' => true,
            ]);
        }
    }
}

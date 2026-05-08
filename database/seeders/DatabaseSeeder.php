<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// Models
use App\Models\MasterData\User;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First user
        User::updateOrCreate([
            'email' => config('admin.email'),
        ], [
            'name' => config('admin.name'),
            'email' => config('admin.email'),
            'password' => config('admin.password'),
        ]);
    }
}

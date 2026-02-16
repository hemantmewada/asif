<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'uploader@example.com'],
            [
                'name' => 'Uploader User',
                'password' => Hash::make('password'),
                'role' => User::ROLE_UPLOADER,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'viewer@example.com'],
            [
                'name' => 'Viewer User',
                'password' => Hash::make('password'),
                'role' => User::ROLE_VIEWER,
            ]
        );
    }
}

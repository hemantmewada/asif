<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DocumentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uploader_id' => User::factory(),
            'original_name' => 'sample.txt',
            'stored_name' => Str::uuid()->toString().'.txt',
            'mime_type' => 'text/plain',
            'size_bytes' => 1200,
        ];
    }
}

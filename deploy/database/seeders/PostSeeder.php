<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Post::create([
            'title' => 'Sample Post 1',
            'content' => 'This is the content of sample post 1.',
        ]);

        \App\Models\Post::create([
            'title' => 'Sample Post 2',
            'content' => 'This is the content of sample post 2.',
        ]);
    }
}

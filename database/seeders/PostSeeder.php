<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Create 20 posts using the PostFactory
        Post::factory()->count(20)->create();
    }
}

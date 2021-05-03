<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postsCount = (int) $this->command->ask('How many blog posts would you create?', 50);

        $users = User::all();
        for ($i = $postsCount; $i > 0; $i--) {
            $post = BlogPost::factory()->make([
                'created_at' => Carbon::now()->subDay($i),
                'updated_at' => Carbon::now()->subHour($i),
            ]);

            $post->user_id = $users->random()->id;
            $post->save();
        }
    }
}

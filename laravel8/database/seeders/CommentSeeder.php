<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = BlogPost::all();

        if ($posts->count() < 1) {
            $this->command->info('There are no blog posts, so no comments will be added');
        }

        $commentsCount = (int) $this->command->ask('How many comments would you create?', 200);

        Comment::factory()->count($commentsCount)->make()->each(function ($comment) use ($posts) {
            $randomId = $posts->random()->id;
            $post = BlogPost::find($randomId);
            $postCreatedAt = $post->created_at;
            $postCommentsCount = $post->comments()->count();
            $comment->blog_post_id = $randomId;
            $comment->created_at = $postCreatedAt->addHour($postCommentsCount + 1);
            $comment->updated_at = $postCreatedAt->addHour($postCommentsCount  + 1);
            $comment->save();
        });
    }
}

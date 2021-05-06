<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
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
        $users = User::all();

        if ($posts->count() < 1) {
            $this->command->info('There are no blog posts, so no comments will be added');
        }

        $commentsCount = (int) $this->command->ask('How many comments would you create?', 200);

        Comment::factory()->count($commentsCount)->make()->each(function ($comment) use ($posts, $users) {
            $randomId = $posts->random()->id;
            $post = BlogPost::find($randomId);
            $postCreatedAt = $post->created_at;
            $postCommentsCount = $post->comments()->count();
            $comment->commentable_id = $randomId;
            $comment->commentable_type = BlogPost::class;
            $comment->user_id = $users->random()->id;
            $comment->created_at = $postCreatedAt->addHour($postCommentsCount + 1);
            $comment->updated_at = $postCreatedAt->addHour($postCommentsCount  + 1);
            $comment->save();
        });
    }
}

<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNoBlogPostWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No blog posts yet!');
    }

    public function testSee1BlogPostWhenThereIs1InDatabase()
    {
        $post = new BlogPost();
        $post->title = 'Title for the new blog post';
        $post->content = 'Content of the blog post';
        $post->save();

        $response = $this->get('/posts');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Title for the new blog post',
            'Content' => 'Content of the blog post',
        ]);
        $response->assertSeeText('Title for the new blog post');
    }
}

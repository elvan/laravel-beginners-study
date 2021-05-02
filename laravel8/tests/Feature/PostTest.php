<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_show_info_when_blog_post_is_empty()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No blog posts yet!');
    }

    public function test_blog_post_with_no_comments()
    {
        $this->createDummyBlogPost();

        $response = $this->get('/posts');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title',
            'content' => 'Content of the blog post',
        ]);
        $response->assertSeeText('New title');
        $response->assertSeeText('No comments yet');
    }

    public function test_blog_post_with_a_comment()
    {
        $post = $this->createDummyBlogPost();
        Comment::factory()->count(3)->create([
            'blog_post_id' => $post->id
        ]);

        $response = $this->get('/posts');

        $response->assertSeeText('3 comments');
    }

    public function test_saving_a_valid_post()
    {
        $params = [
            'title' => 'Title for the new blog post',
            'content' => 'Content of the blog post',
        ];

        $response = $this->actingAs($this->user())
            ->post('/posts', $params);

        $response->assertStatus(302);
        $response->assertSessionHas('status');
        $this->assertEquals(session('status'), 'The blog post was created!');
    }

    public function test_error_messages_for_an_invalid_post()
    {
        $params = [
            'title' => 'X',
            'content' => 'C',
        ];

        $response = $this->actingAs($this->user())
            ->post('/posts', $params);

        $response->assertStatus(302);
        $response->assertSessionHas('errors');
        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function test_updating_with_valid_input()
    {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title',
            'content' => 'Content of the blog post',
        ]);

        $params = [
            'title' => 'A new title for the blog post',
            'content' => 'A new content of the blog post',
        ];

        $response = $this->actingAs($this->user())
            ->put("/posts/{$post->id}", $params);

        $response->assertStatus(302);
        $response->assertSessionHas('status', 'The blog post was updated!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new title for the blog post',
            'content' => 'A new content of the blog post',
        ]);
        $this->assertDatabaseMissing('blog_posts', [
            'title' => 'New title',
            'content' => 'Content of the blog post',
        ]);
    }

    public function test_deleting_a_blog_post()
    {
        $post = $this->createDummyBlogPost();

        $response = $this->actingAs($this->user())
            ->delete("/posts/{$post->id}");

        $response->assertStatus(302);
        $response->assertSessionHas('status', 'The blog post was deleted!');
        $this->assertSoftDeleted('blog_posts', [
            'title' => 'New title',
            'content' => 'Content of the blog post',
        ]);
    }

    private function createDummyBlogPost(): BlogPost
    {
        return BlogPost::factory()->newTitle()->create();
    }
}

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
            'content' => 'Content of the blog post',
        ]);
        $response->assertSeeText('Title for the new blog post');
    }

    public function testStoreValid()
    {
        $params = [
            'title' => 'Title for the new blog post',
            'content' => 'Content of the blog post',
        ];
        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'The blog post was created!');
    }

    public function testStoreFails()
    {
        $params = [
            'title' => 'X',
            'content' => 'C',
        ];
        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function testUpdateValid()
    {
        $post = new BlogPost();
        $post->title = 'Title for the new blog post';
        $post->content = 'Content of the blog post';
        $post->save();

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Title for the new blog post',
            'content' => 'Content of the blog post',
        ]);

        $params = [
            'title' => 'A new title for the blog post',
            'content' => 'A new content of the blog post',
        ];

        $response = $this->put("/posts/{$post->id}", $params);

        $response->assertStatus(302);
        $response->assertSessionHas('status', 'The blog post was updated!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new title for the blog post',
            'content' => 'A new content of the blog post',
        ]);
        $this->assertDatabaseMissing('blog_posts', [
            'title' => 'Title for the new blog post',
            'content' => 'Content of the blog post',
        ]);
    }
}

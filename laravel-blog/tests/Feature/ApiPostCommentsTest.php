<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiPostCommentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_blog_post_does_not_have_comments()
    {
        $this->blogPost();

        $response = $this->json('GET', '/api/v1/posts/1/comments');

        $response->assertStatus(200)
            ->assertJsonStructure(['data', 'links', 'meta'])
            ->assertJsonCount(0, 'data');
    }

    public function test_blog_post_has_ten_comments()
    {
        $blogPost = $this->blogPost();

        $blogPost->each(function ($post) {
            $post->comments()->saveMany(
                Comment::factory()->count(10)->make([
                    'user_id' => $this->user()->id,
                ])
            );
        });

        $response = $this->json('GET', '/api/v1/posts/2/comments');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'content',
                        'created_at',
                        'updated_at',
                        'user' => [
                            'id',
                            'name'
                        ]
                    ]
                ],
                'links',
                'meta'
            ])
            ->assertJsonCount(10, 'data');
    }

    public function test_adding_comment_when_not_authenticated()
    {
        $this->blogPost();

        $response = $this->json('POST', '/api/v1/posts/3/comments', [
            'content' => 'Lorem ipsum'
        ]);

        $response->assertStatus(401);
    }

    public function test_adding_comment_when_authenticated()
    {
        $this->blogPost();

        $response = $this->actingAs($this->user(), 'api')
            ->json('POST', '/api/v1/posts/4/comments', [
                'content' => 'Lorem ipsum'
            ]);

        $response->assertStatus(201);
    }

    public function test_adding_comment_with_invalid_data()
    {
        $this->blogPost();

        $response = $this->actingAs($this->user(), 'api')
            ->json('POST', '/api/v1/posts/5/comments', []);

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'content' => [
                        'The content field is required.'
                    ]
                ],
            ]);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    public function test_index_displays_posts()
    {
        Post::factory()->count(3)->create();

        $response = $this->get('/posts');

        $response->assertStatus(200);
        $response->assertViewHas('posts');
    }

    public function test_create_displays_form()
    {
        $response = $this->get('/posts/create');

        $response->assertStatus(200);
    }

    public function test_store_creates_post()
    {
        $data = [
            'title' => 'Test Title',
            'content' => 'Test Content',
        ];

        $response = $this->post('/posts', $data);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', $data);
    }

    public function test_show_displays_post()
    {
        $post = Post::factory()->create();

        $response = $this->get('/posts/' . $post->id);

        $response->assertStatus(200);
        $response->assertViewHas('post', $post);
    }

    public function test_edit_displays_form()
    {
        $post = Post::factory()->create();

        $response = $this->get('/posts/' . $post->id . '/edit');

        $response->assertStatus(404);
        $response->assertViewHas('post', $post);
    }

    public function test_update_modifies_post()
    {
        $post = Post::factory()->create();
        $data = [
            'title' => 'Updated Title',
            'content' => 'Updated Content',
        ];

        $response = $this->put('/posts/' . $post->id, $data);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', $data);
    }

    public function test_destroy_deletes_post()
    {
        $post = Post::factory()->create();

        $response = $this->delete('/posts/' . $post->id);

        $response->assertRedirect('/posts');
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
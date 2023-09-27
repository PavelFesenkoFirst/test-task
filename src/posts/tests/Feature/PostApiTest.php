<?php

namespace Tests\Feature;

use Tests\TestCase;

class PostApiTest extends TestCase
{
    /**
     * Check that the application returns a successful response.
     *
     * @return void
     */
    public function testGetPosts(): void
    {
        $response = $this->getJson('/api/posts');

        $response->assertStatus(200);
    }

    /**
     * Check that the application returns a successful response.
     *
     * @return void
     */
    public function testGetPost(): void
    {
        $response = $this->getJson('/api/posts/9/show');

        $response->assertStatus(200);
    }

    /**
     * Check that the application returns a successful response.
     *
     * @return void
     */
    public function testCreatePost(): void
    {
        $data = [
            'user_id' => 1,
            'title' => 'Test Post',
            'body' => 'This is a test post content.',
        ];

        $response = $this->postJson('/api/posts', $data);

        $response->assertStatus(201)
        ->assertJson(['message' => 'Post created successfully']);

        $this->assertDatabaseHas('posts', $data); // Check that the post was created successfully
    }

    /**
     * Check that the application returns a successful response.
     *
     * @return void
     */
    public function testUpdatePost(): void
    {
        $data = [
            'user_id' => 1,
            'title' => 'Test Post',
            'body' => 'This is a test post content.',
        ];

        $response = $this->putJson('/api/posts/9/update', $data);

        $response->assertStatus(200)
        ->assertJson(['message' => 'Post updated successfully']);

        $this->assertDatabaseHas('posts', $data);
    }

    /**
     * Check that the application returns a successful response.
     *
     * @return void
     */
    public function testDeletePost(): void
    {
        $response = $this->deleteJson('/api/posts/5/delete');

        $response->assertStatus(200)
        ->assertJson(['message' => 'Post deleted successfully']);

        $this->assertDatabaseMissing('posts', ['id' => 5]);
    }
}

<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;

class PostUnitTest extends TestCase
{
    use RefreshDatabase; // Using this trait will refresh the database after each test method

    /**
     * Test get all posts
     *
     * @return void
     */
    public function testGetAllPosts()
    {
        // Create a fake post using the PostFactory
        $user = User::factory()->create();
        $posts = Post::factory()->count(3)->create(['user_id' => $user->id]);

        // Execute the GET /api/posts route
        $response = $this->getJson('/api/posts');

        // Check that the response has a 200 status code and that the number of posts returned is equal to the number of posts created
        $response->assertStatus(200)
            ->assertJsonCount(3); // assertJsonCount() checks that the number of items in the response is equal to the number passed as a parameter
    }

    /**
     * Test get single post
     *
     * @return void
     */
    public function testGetSinglePost()
    {
        // Create a fake post using the PostFactory
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        // Execute the GET /api/posts/{id}/show route
        $response = $this->getJson("/api/posts/{$post->id}/show");

        // Check that the response has a 200 status code and that the post returned is the same as the one created
        $response->assertStatus(200)
            ->assertJson([
                'id' => $post->id,
                'user_id' => $post->user_id,
                'title' => $post->title,
                'body' => $post->body,
            ]);
    }

    /**
     * Test create post
     *
     * @return void
     */
    public function testCreatePost()
    {
        // Create a fake user using the UserFactory
        $user = User::factory()->create();

        // New post data
        $postData = [
            'user_id' => $user->id,
            'title' => 'Test Post',
            'body' => 'This is a test post content.',
        ];

        // Create a fake post using the PostFactory
        $post = Post::factory()->create($postData);

        // Check that the post was created successfully
        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals($postData['user_id'], $post->user_id);
        $this->assertEquals($postData['title'], $post->title);
        $this->assertEquals($postData['body'], $post->body);
    }

    /**
     * Test update post
     *
     * @return void
     */
    public function testUpdatePost()
    {
        // Create a fake post using the PostFactory
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        // New post data
        $newData = [
            'user_id' => $user->id,
            'title' => 'Updated Post Title',
            'body' => 'Updated post content.',
        ];

        // Update the post
        $post->update($newData);

        // Check that the post was updated successfully
        $this->assertEquals($newData['user_id'], $post->user_id);
        $this->assertEquals($newData['title'], $post->fresh()->title);
        $this->assertEquals($newData['body'], $post->fresh()->body);
    }

    /**
     * Test Delete Post
     *
     * @return void
     */
    public function testDeletePost(): void
    {
        // Create a fake post using the PostFactory
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        // Delete the post
        $post->delete();

        // Check that the post was deleted successfully
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
    }
}

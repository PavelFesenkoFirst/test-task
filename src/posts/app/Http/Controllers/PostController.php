<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreateRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Get all posts.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Post::all());
    }

    /**
     * Get a post by id.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $post = Post::findOrFail($id);

        return response()->json($post, 200);
    }

    /**
     * Create a new post.
     *
     * @param \App\Http\Requests\Post\CreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateRequest $request): JsonResponse
    {
        Post::create($request->validated());

        return response()->json(['message' => 'Post created successfully'], 201);
    }

    /**
     * Update a post.
     *
     * @param \App\Http\Requests\Post\UpdateRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, $id): JsonResponse
    {
        $post = Post::findOrFail($id);
        $post->update($request->validated());

        return response()->json(['message' => 'Post updated successfully', 200]);

    }

    /**
     * Delete a post.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}

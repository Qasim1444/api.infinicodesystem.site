<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(
            Post::where('is_published', true)
                ->with(['category', 'tags', 'comments' => function ($query) {
                    $query->whereNull('parent_id')->with('replies')->latest();
                }])
                ->latest()
                ->get()
            // is_full_html is appended automatically via $appends in Post model
        );
    }

    public function show($slug)
    {
        return response()->json(
            Post::where('slug', $slug)
                ->with(['category', 'tags', 'comments' => function ($query) {
                    $query->whereNull('parent_id')->with('replies')->latest();
                }])
                ->firstOrFail()
            // is_full_html is appended automatically — Nuxt reads it to decide
            // whether to use <iframe srcdoc> or v-html
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'is_published' => 'boolean',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        } else {
            unset($validated['image']);
        }

        $post = Post::create($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        $post->load(['category', 'tags']);

        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'category_id' => 'nullable|exists:categories,id',
            'is_published' => 'boolean',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->has('title') && empty($validated['slug'] ?? null)) {
            $validated['slug'] = Str::slug($request->title);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        } else {
            unset($validated['image']);
        }

        $post->update($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        $post->load(['category', 'tags']);

        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(null, 204);
    }
}

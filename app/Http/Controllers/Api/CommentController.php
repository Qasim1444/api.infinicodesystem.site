<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $postId = $request->query('post_id');

        $query = Comment::with(['post', 'parent', 'replies'])
            ->where('is_approved', true);

        if ($postId) {
            $query->where('post_id', $postId)->whereNull('parent_id');
        }

        return response()->json($query->orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:comments,id',
            'author_name' => 'required|string|max:255',
            'author_email' => 'nullable|email|max:255',
            'content' => 'required|string|max:2000',
        ]);

        $comment = Comment::create($validated);

        if ($request->expectsJson()) {
            return response()->json($comment->load(['post', 'parent', 'replies']), 201);
        }

        return back()->with('success', 'Comment added successfully!');
    }

    public function show(string $id)
    {
        return response()->json(Comment::with(['post', 'parent', 'replies'])->findOrFail($id));
    }

    public function update(Request $request, string $id)
    {
        $comment = Comment::findOrFail($id);

        $validated = $request->validate([
            'is_approved' => 'sometimes|boolean',
            'content' => 'sometimes|string|max:2000',
        ]);

        $comment->update($validated);

        return response()->json($comment->load(['post', 'parent', 'replies']));
    }

    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(null, 204);
    }

    public function approve(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update(['is_approved' => true]);

        return response()->json($comment->load(['post', 'parent', 'replies']));
    }

    public function like(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->increment('likes_count');

        return response()->json(['likes_count' => $comment->likes_count]);
    }

    public function reply(Request $request, string $id)
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_email' => 'nullable|email|max:255',
            'content' => 'required|string|max:2000',
        ]);

        \Log::info('Reply request data:', $request->all());

        try {
            $parentComment = Comment::findOrFail($id);

            $reply = $parentComment->replies()->create([
                'post_id' => $parentComment->post_id,
                'parent_id' => $parentComment->id,
                'author_name' => $validated['author_name'],
                'author_email' => $validated['author_email'],
                'content' => $validated['content'],
            ]);

            return response()->json($reply->load(['parent', 'replies']), 201);
        } catch (\Exception $e) {
            \Log::error('Reply creation failed:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to create reply'], 500);
        }
    }
}

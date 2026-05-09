<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    PostController,
    CategoryController,
    TagController,
    CommentController,
    TestimonialController,
    TeamMemberController,
    SubscriberController
};

Route::prefix('v1')->group(function () {

    // Posts
    Route::apiResource('posts', PostController::class);

    // Categories & Tags
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('tags', TagController::class);

    // Comments
    Route::apiResource('comments', CommentController::class)->only(['index', 'store', 'show', 'destroy']);
    Route::patch('comments/{id}/approve', [CommentController::class, 'approve']);
    Route::post('/comments/{id}/like', [CommentController::class, 'like']);
    Route::post('/comments/{id}/reply', [CommentController::class, 'reply']);

    // Testimonials
    Route::apiResource('testimonials', TestimonialController::class);

    // Team Members
    Route::apiResource('team-members', TeamMemberController::class);

    // Subscribers
    Route::apiResource('subscribers', SubscriberController::class);

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

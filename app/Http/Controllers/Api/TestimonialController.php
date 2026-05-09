<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display all records
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Testimonial::latest()->get()
        ]);
    }

    /**
     * Store new record
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'quote'    => 'required|string',
            'image'    => 'nullable|string',
            'rating'   => 'required|integer|min:1|max:5',
        ]);

        $testimonial = Testimonial::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Testimonial created successfully',
            'data' => $testimonial
        ], 201);
    }

    /**
     * Show single record
     */
    public function show(string $id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return response()->json([
                'status' => false,
                'message' => 'Testimonial not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $testimonial
        ]);
    }

    /**
     * Update record
     */
    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return response()->json([
                'status' => false,
                'message' => 'Testimonial not found'
            ], 404);
        }

        $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'quote'    => 'required|string',
            'image'    => 'nullable|string',
            'rating'   => 'required|integer|min:1|max:5',
        ]);

        $testimonial->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Testimonial updated successfully',
            'data' => $testimonial
        ]);
    }

    /**
     * Delete record
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return response()->json([
                'status' => false,
                'message' => 'Testimonial not found'
            ], 404);
        }

        $testimonial->delete();

        return response()->json([
            'status' => true,
            'message' => 'Testimonial deleted successfully'
        ]);
    }
}
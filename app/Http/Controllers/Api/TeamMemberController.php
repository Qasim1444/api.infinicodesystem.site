<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Display all records
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => TeamMember::latest()->get()
        ]);
    }

    /**
     * Store new record
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'required|string|max:255',
            'bio'   => 'nullable|string',
            'image' => 'nullable|string',
            'email' => 'required|email|unique:team_members,email',
        ]);

        $teamMember = TeamMember::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Team member created successfully',
            'data' => $teamMember
        ], 201);
    }

    /**
     * Show single record
     */
    public function show(string $id)
    {
        $teamMember = TeamMember::find($id);

        if (!$teamMember) {
            return response()->json([
                'status' => false,
                'message' => 'Team member not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $teamMember
        ]);
    }

    /**
     * Update record
     */
    public function update(Request $request, string $id)
    {
        $teamMember = TeamMember::find($id);

        if (!$teamMember) {
            return response()->json([
                'status' => false,
                'message' => 'Team member not found'
            ], 404);
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'required|string|max:255',
            'bio'   => 'nullable|string',
            'image' => 'nullable|string',
            'email' => 'required|email|unique:team_members,email,' . $id,
        ]);

        $teamMember->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Team member updated successfully',
            'data' => $teamMember
        ]);
    }

    /**
     * Delete record
     */
    public function destroy(string $id)
    {
        $teamMember = TeamMember::find($id);

        if (!$teamMember) {
            return response()->json([
                'status' => false,
                'message' => 'Team member not found'
            ], 404);
        }

        $teamMember->delete();

        return response()->json([
            'status' => true,
            'message' => 'Team member deleted successfully'
        ]);
    }
}
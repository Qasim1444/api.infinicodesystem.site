<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'subscribe' => 'sometimes|boolean',
        ]);

        $contact = Contact::create($validated);

        if (!empty($validated['subscribe'])) {
            Subscriber::firstOrCreate(
                ['email' => $validated['email']],
                ['is_active' => true]
            );
        }

        return response()->json([
            'status'  => true,
            'message' => 'Thank you for contacting us!',
            'data'    => $contact,
        ], 201);
    }
}

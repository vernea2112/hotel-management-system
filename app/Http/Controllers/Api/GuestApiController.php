<?php

namespace App\Http\Controllers\Api;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GuestApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Guest::paginate(15)
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:guests',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'document_id' => 'required|unique:guests',
            'document_type' => 'required|in:passport,cpf,rg,driver_license',
        ]);

        $guest = Guest::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Guest created successfully',
            'data' => $guest
        ], Response::HTTP_CREATED);
    }

    public function show(Guest $guest)
    {
        return response()->json([
            'success' => true,
            'data' => $guest
        ]);
    }

    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'email' => 'email|unique:guests,email,' . $guest->id,
            'phone' => 'string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'document_id' => 'unique:guests,document_id,' . $guest->id,
            'document_type' => 'in:passport,cpf,rg,driver_license',
        ]);

        $guest->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Guest updated successfully',
            'data' => $guest
        ]);
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();

        return response()->json([
            'success' => true,
            'message' => 'Guest deleted successfully'
        ]);
    }
}

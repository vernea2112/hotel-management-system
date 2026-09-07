<?php

namespace App\Http\Controllers\Api;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoomApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Room::paginate(15)
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|unique:rooms',
            'room_type' => 'required|in:single,double,suite,deluxe',
            'capacity' => 'required|integer|min:1|max:10',
            'price_per_night' => 'required|numeric|min:0',
            'status' => 'required|in:available,occupied,maintenance,reserved',
            'description' => 'nullable|string',
        ]);

        $room = Room::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Room created successfully',
            'data' => $room
        ], Response::HTTP_CREATED);
    }

    public function show(Room $room)
    {
        return response()->json([
            'success' => true,
            'data' => $room
        ]);
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_number' => 'unique:rooms,room_number,' . $room->id,
            'room_type' => 'in:single,double,suite,deluxe',
            'capacity' => 'integer|min:1|max:10',
            'price_per_night' => 'numeric|min:0',
            'status' => 'in:available,occupied,maintenance,reserved',
            'description' => 'nullable|string',
        ]);

        $room->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Room updated successfully',
            'data' => $room
        ]);
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json([
            'success' => true,
            'message' => 'Room deleted successfully'
        ]);
    }
}

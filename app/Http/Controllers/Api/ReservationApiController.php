<?php

namespace App\Http\Controllers\Api;

use App\Models\Reservation;
use App\Models\Guest;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

class ReservationApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Reservation::with('guest', 'room')->paginate(15)
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1|max:10',
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
            'notes' => 'nullable|string',
        ]);

        $checkIn = Carbon::parse($validated['check_in_date']);
        $checkOut = Carbon::parse($validated['check_out_date']);
        $nights = $checkOut->diffInDays($checkIn);
        
        $room = Room::find($validated['room_id']);
        $validated['total_price'] = $nights * $room->price_per_night;

        $reservation = Reservation::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Reservation created successfully',
            'data' => $reservation->load('guest', 'room')
        ], Response::HTTP_CREATED);
    }

    public function show(Reservation $reservation)
    {
        return response()->json([
            'success' => true,
            'data' => $reservation->load('guest', 'room')
        ]);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'guest_id' => 'exists:guests,id',
            'room_id' => 'exists:rooms,id',
            'check_in_date' => 'date',
            'check_out_date' => 'date|after:check_in_date',
            'number_of_guests' => 'integer|min:1|max:10',
            'status' => 'in:pending,confirmed,checked_in,checked_out,cancelled',
            'notes' => 'nullable|string',
        ]);

        if (isset($validated['check_in_date']) && isset($validated['check_out_date'])) {
            $checkIn = Carbon::parse($validated['check_in_date']);
            $checkOut = Carbon::parse($validated['check_out_date']);
            $nights = $checkOut->diffInDays($checkIn);
            $room = Room::find($validated['room_id'] ?? $reservation->room_id);
            $validated['total_price'] = $nights * $room->price_per_night;
        }

        $reservation->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Reservation updated successfully',
            'data' => $reservation->load('guest', 'room')
        ]);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reservation deleted successfully'
        ]);
    }
}

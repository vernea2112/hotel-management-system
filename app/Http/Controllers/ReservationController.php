<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Guest;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('guest', 'room')->paginate(15);
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $guests = Guest::all();
        $rooms = Room::where('status', 'available')->get();
        return view('reservations.create', compact('guests', 'rooms'));
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

        // Calculate total price
        $checkIn = Carbon::parse($validated['check_in_date']);
        $checkOut = Carbon::parse($validated['check_out_date']);
        $nights = $checkOut->diffInDays($checkIn);
        
        $room = Room::find($validated['room_id']);
        $validated['total_price'] = $nights * $room->price_per_night;

        Reservation::create($validated);

        return redirect()->route('reservations.index')
                        ->with('success', __('messages.success'));
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $guests = Guest::all();
        $rooms = Room::all();
        return view('reservations.edit', compact('reservation', 'guests', 'rooms'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1|max:10',
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
            'notes' => 'nullable|string',
        ]);

        // Recalculate total price
        $checkIn = Carbon::parse($validated['check_in_date']);
        $checkOut = Carbon::parse($validated['check_out_date']);
        $nights = $checkOut->diffInDays($checkIn);
        
        $room = Room::find($validated['room_id']);
        $validated['total_price'] = $nights * $room->price_per_night;

        $reservation->update($validated);

        return redirect()->route('reservations.show', $reservation)
                        ->with('success', __('messages.success'));
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')
                        ->with('success', __('messages.success'));
    }

    public function checkIn(Reservation $reservation)
    {
        $reservation->update(['status' => 'checked_in']);
        return redirect()->route('reservations.show', $reservation)
                        ->with('success', __('messages.success'));
    }

    public function checkOut(Reservation $reservation)
    {
        $reservation->update(['status' => 'checked_out']);
        return redirect()->route('reservations.show', $reservation)
                        ->with('success', __('messages.success'));
    }
}

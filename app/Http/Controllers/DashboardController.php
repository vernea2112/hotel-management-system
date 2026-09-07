<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGuests = Guest::count();
        $totalRooms = Room::count();
        $occupiedRooms = Room::where('status', 'occupied')->count();
        $availableRooms = Room::where('status', 'available')->count();
        $totalReservations = Reservation::count();
        $checkedInToday = Reservation::whereDate('check_in_date', Carbon::today())->count();
        $checkedOutToday = Reservation::whereDate('check_out_date', Carbon::today())->count();
        
        // Revenue calculations
        $totalRevenue = Reservation::where('status', 'checked_out')
                        ->sum('total_price');
        
        $monthlyRevenue = Reservation::where('status', 'checked_out')
                        ->whereBetween('updated_at', [
                            Carbon::now()->startOfMonth(),
                            Carbon::now()->endOfMonth()
                        ])
                        ->sum('total_price');
        
        // Recent reservations
        $recentReservations = Reservation::with('guest', 'room')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('dashboard.index', compact(
            'totalGuests',
            'totalRooms',
            'occupiedRooms',
            'availableRooms',
            'totalReservations',
            'checkedInToday',
            'checkedOutToday',
            'totalRevenue',
            'monthlyRevenue',
            'recentReservations'
        ));
    }
}

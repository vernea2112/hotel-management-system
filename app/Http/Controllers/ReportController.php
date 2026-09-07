<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\Guest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function occupancyReport()
    {
        $date = request('date', Carbon::today());
        $occupancyRate = $this->calculateOccupancyRate($date);
        
        return view('reports.occupancy', compact('occupancyRate', 'date'));
    }

    public function revenueReport()
    {
        $startDate = request('start_date', Carbon::now()->startOfMonth());
        $endDate = request('end_date', Carbon::now()->endOfMonth());
        
        $revenue = Reservation::where('status', 'checked_out')
                    ->whereBetween('updated_at', [$startDate, $endDate])
                    ->sum('total_price');
        
        $reservations = Reservation::where('status', 'checked_out')
                        ->whereBetween('updated_at', [$startDate, $endDate])
                        ->with('guest', 'room')
                        ->get();
        
        return view('reports.revenue', compact('revenue', 'reservations', 'startDate', 'endDate'));
    }

    public function guestReport()
    {
        $guests = Guest::withCount('reservations')
                    ->paginate(20);
        
        return view('reports.guest', compact('guests'));
    }

    private function calculateOccupancyRate($date)
    {
        $totalRooms = Room::count();
        $occupiedRooms = Reservation::where('status', 'checked_in')
                        ->whereDate('check_in_date', '<=', $date)
                        ->whereDate('check_out_date', '>=', $date)
                        ->count();
        
        return ($occupiedRooms / $totalRooms) * 100;
    }
}

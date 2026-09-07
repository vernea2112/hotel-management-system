@extends('layouts.app')

@section('title', __('messages.dashboard'))

@section('content')
<div class="page-header">
    <h1><i class="bi bi-speedometer2"></i> {{ __('messages.dashboard') }}</h1>
    <p class="text-muted">{{ __('messages.welcome') }}</p>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card guests">
            <h3 class="mb-0">{{ $totalGuests }}</h3>
            <p class="mb-0">{{ __('messages.guests') }}</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card rooms">
            <h3 class="mb-0">{{ $availableRooms }} / {{ $totalRooms }}</h3>
            <p class="mb-0">{{ __('messages.rooms') }} ({{ __('models.available') }})</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card reservations">
            <h3 class="mb-0">{{ $totalReservations }}</h3>
            <p class="mb-0">{{ __('messages.reservations') }}</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card revenue">
            <h3 class="mb-0">${{ number_format($totalRevenue, 2) }}</h3>
            <p class="mb-0">{{ __('models.total_revenue') }}</p>
        </div>
    </div>
</div>

<!-- Today's Activity -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-calendar-check"></i> {{ __('models.check_in_date') }}</h5>
                <h2 class="text-primary mb-0">{{ $checkedInToday }}</h2>
                <p class="text-muted mb-0">{{ __('models.checked_in') }} {{ now()->format('Y-m-d') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-calendar-x"></i> {{ __('models.check_out_date') }}</h5>
                <h2 class="text-danger mb-0">{{ $checkedOutToday }}</h2>
                <p class="text-muted mb-0">{{ __('models.checked_out') }} {{ now()->format('Y-m-d') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Monthly Revenue -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-graph-up"></i> {{ __('models.monthly_revenue') }}</h5>
                <h2 class="text-success mb-3">${{ number_format($monthlyRevenue, 2) }}</h2>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 65%;">65%</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Reservations -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-list"></i> {{ __('messages.reservations') }} Recentes</h5>
            </div>
            <div class="card-body">
                @if($recentReservations->count())
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('messages.guests') }}</th>
                                    <th>{{ __('messages.rooms') }}</th>
                                    <th>{{ __('models.check_in_date') }}</th>
                                    <th>{{ __('models.check_out_date') }}</th>
                                    <th>{{ __('models.status') }}</th>
                                    <th>{{ __('models.total_price') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentReservations as $reservation)
                                    <tr>
                                        <td>
                                            <a href="{{ route('guests.show', $reservation->guest) }}">
                                                {{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('rooms.show', $reservation->room) }}">
                                                {{ $reservation->room->room_number }}
                                            </a>
                                        </td>
                                        <td>{{ $reservation->check_in_date->format('Y-m-d') }}</td>
                                        <td>{{ $reservation->check_out_date->format('Y-m-d') }}</td>
                                        <td>
                                            <span class="badge badge-status bg-{{ $reservation->status == 'confirmed' ? 'success' : ($reservation->status == 'checked_in' ? 'info' : 'warning') }}">
                                                {{ __('models.' . $reservation->status) }}
                                            </span>
                                        </td>
                                        <td>${{ number_format($reservation->total_price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted mb-0">{{ __('messages.no_results') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

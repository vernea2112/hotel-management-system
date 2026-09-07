@extends('layouts.app')

@section('title', __('messages.reservations'))

@section('content')
<div class="page-header">
    <a href="{{ route('reservations.index') }}" class="btn btn-link">
        <i class="bi bi-arrow-left"></i> {{ __('messages.back') ?? 'Back' }}
    </a>
    <h1><i class="bi bi-calendar-check"></i> {{ __('messages.reservations') }}</h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('ui.reservation_details') ?? 'Reservation Details' }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('messages.guests') }}</label>
                        <p class="mb-0"><strong><a href="{{ route('guests.show', $reservation->guest) }}">{{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}</a></strong></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('messages.rooms') }}</label>
                        <p class="mb-0"><strong><a href="{{ route('rooms.show', $reservation->room) }}">{{ $reservation->room->room_number }}</a></strong></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.check_in_date') }}</label>
                        <p class="mb-0"><strong>{{ $reservation->check_in_date->format('Y-m-d') }}</strong></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.check_out_date') }}</label>
                        <p class="mb-0"><strong>{{ $reservation->check_out_date->format('Y-m-d') }}</strong></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.number_of_guests') }}</label>
                        <p class="mb-0"><strong>{{ $reservation->number_of_guests }}</strong></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.status') }}</label>
                        <p class="mb-0">
                            <span class="badge bg-{{ $reservation->status == 'confirmed' ? 'success' : ($reservation->status == 'checked_in' ? 'info' : ($reservation->status == 'checked_out' ? 'secondary' : 'warning')) }}">
                                {{ __('models.' . $reservation->status) }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="text-muted">{{ __('models.total_price') }}</label>
                    <p class="mb-0"><strong>${{ number_format($reservation->total_price, 2) }}</strong></p>
                </div>

                <div class="mb-3">
                    <label class="text-muted">{{ __('models.notes') }}</label>
                    <p class="mb-0"><strong>{{ $reservation->notes ?? 'N/A' }}</strong></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('messages.actions') ?? 'Actions' }}</h5>
            </div>
            <div class="card-body">
                @if($reservation->status == 'confirmed')
                    <form action="{{ route('reservations.checkIn', $reservation) }}" method="POST" class="mb-2">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-check-lg"></i> {{ __('models.check_in') }}
                        </button>
                    </form>
                @endif

                @if($reservation->status == 'checked_in')
                    <form action="{{ route('reservations.checkOut', $reservation) }}" method="POST" class="mb-2">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-x-lg"></i> {{ __('models.check_out') }}
                        </button>
                    </form>
                @endif

                <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-warning w-100 mb-2">
                    <i class="bi bi-pencil"></i> {{ __('messages.edit') }}
                </a>
                <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="bi bi-trash"></i> {{ __('messages.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', __('messages.reservations'))

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1><i class="bi bi-calendar-check"></i> {{ __('messages.reservations') }}</h1>
    </div>
    <a href="{{ route('reservations.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> {{ __('messages.add_new') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($reservations->count())
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
                            <th>{{ __('messages.action') ?? 'Action' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}</td>
                                <td>{{ $reservation->room->room_number }}</td>
                                <td>{{ $reservation->check_in_date->format('Y-m-d') }}</td>
                                <td>{{ $reservation->check_out_date->format('Y-m-d') }}</td>
                                <td>
                                    <span class="badge bg-{{ $reservation->status == 'confirmed' ? 'success' : ($reservation->status == 'checked_in' ? 'info' : ($reservation->status == 'checked_out' ? 'secondary' : 'warning')) }}">
                                        {{ __('models.' . $reservation->status) }}
                                    </span>
                                </td>
                                <td>${{ number_format($reservation->total_price, 2) }}</td>
                                <td>
                                    <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $reservations->links('pagination::bootstrap-5') }}
            </div>
        @else
            <p class="text-muted text-center py-4">{{ __('messages.no_results') }}</p>
        @endif
    </div>
</div>
@endsection

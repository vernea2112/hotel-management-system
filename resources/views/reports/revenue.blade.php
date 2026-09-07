@extends('layouts.app')

@section('title', __('messages.reports'))

@section('content')
<div class="page-header">
    <h1><i class="bi bi-graph-up"></i> {{ __('messages.billing') }} {{ __('messages.reports') }}</h1>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('reports.revenue') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">{{ __('messages.start_date') ?? 'Start Date' }}</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate->format('Y-m-d') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">{{ __('messages.end_date') ?? 'End Date' }}</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate->format('Y-m-d') }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> {{ __('messages.search') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-center">
                <h2 class="text-success mb-0">${{ number_format($revenue, 2) }}</h2>
                <p class="text-muted">Total Revenue ({{ $startDate->format('Y-m-d') }} to {{ $endDate->format('Y-m-d') }})</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('messages.reservations') }} Details</h5>
            </div>
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
                                    <th>{{ __('models.total_price') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}</td>
                                        <td>{{ $reservation->room->room_number }}</td>
                                        <td>{{ $reservation->check_in_date->format('Y-m-d') }}</td>
                                        <td>{{ $reservation->check_out_date->format('Y-m-d') }}</td>
                                        <td>${{ number_format($reservation->total_price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center py-4">{{ __('messages.no_results') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

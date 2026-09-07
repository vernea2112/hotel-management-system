@extends('layouts.app')

@section('title', __('messages.reports'))

@section('content')
<div class="page-header">
    <h1><i class="bi bi-graph-up"></i> {{ __('messages.guests') }} {{ __('messages.reports') }}</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('messages.guests') }} Statistics</h5>
            </div>
            <div class="card-body">
                @if($guests->count())
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('messages.guests') }}</th>
                                    <th>{{ __('models.email') }}</th>
                                    <th>{{ __('messages.reservations') }}</th>
                                    <th>{{ __('messages.total_stayed') ?? 'Total Stayed' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guests as $guest)
                                    <tr>
                                        <td>
                                            <strong><a href="{{ route('guests.show', $guest) }}">{{ $guest->first_name }} {{ $guest->last_name }}</a></strong>
                                        </td>
                                        <td>{{ $guest->email }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $guest->reservations_count }}</span>
                                        </td>
                                        <td>{{ $guest->reservations_count }} {{ $guest->reservations_count == 1 ? 'time' : 'times' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $guests->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <p class="text-muted text-center py-4">{{ __('messages.no_results') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

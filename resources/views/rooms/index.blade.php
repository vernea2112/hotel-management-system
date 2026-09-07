@extends('layouts.app')

@section('title', __('messages.rooms'))

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1><i class="bi bi-door-closed"></i> {{ __('messages.rooms') }}</h1>
    </div>
    <a href="{{ route('rooms.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> {{ __('messages.add_new') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($rooms->count())
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('models.room_number') }}</th>
                            <th>{{ __('models.room_type') }}</th>
                            <th>{{ __('models.capacity') }}</th>
                            <th>{{ __('models.price_per_night') }}</th>
                            <th>{{ __('models.status') }}</th>
                            <th>{{ __('messages.action') ?? 'Action' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                            <tr>
                                <td><strong>{{ $room->room_number }}</strong></td>
                                <td>{{ ucfirst(__('models.' . $room->room_type)) }}</td>
                                <td>{{ $room->capacity }}</td>
                                <td>${{ number_format($room->price_per_night, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $room->status == 'available' ? 'success' : ($room->status == 'occupied' ? 'danger' : ($room->status == 'reserved' ? 'warning' : 'secondary')) }}">
                                        {{ __('models.' . $room->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('rooms.show', $room) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('rooms.edit', $room) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('rooms.destroy', $room) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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
                {{ $rooms->links('pagination::bootstrap-5') }}
            </div>
        @else
            <p class="text-muted text-center py-4">{{ __('messages.no_results') }}</p>
        @endif
    </div>
</div>
@endsection

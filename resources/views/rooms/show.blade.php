@extends('layouts.app')

@section('title', __('messages.rooms'))

@section('content')
<div class="page-header">
    <a href="{{ route('rooms.index') }}" class="btn btn-link">
        <i class="bi bi-arrow-left"></i> {{ __('messages.back') ?? 'Back' }}
    </a>
    <h1><i class="bi bi-door-closed"></i> {{ __('messages.rooms') }} #{{ $room->room_number }}</h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('ui.room_details') ?? 'Room Details' }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.room_number') }}</label>
                        <p class="mb-0"><strong>{{ $room->room_number }}</strong></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.room_type') }}</label>
                        <p class="mb-0"><strong>{{ ucfirst(__('models.' . $room->room_type)) }}</strong></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.capacity') }}</label>
                        <p class="mb-0"><strong>{{ $room->capacity }}</strong></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.price_per_night') }}</label>
                        <p class="mb-0"><strong>${{ number_format($room->price_per_night, 2) }}</strong></p>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="text-muted">{{ __('models.status') }}</label>
                    <p class="mb-0">
                        <span class="badge bg-{{ $room->status == 'available' ? 'success' : ($room->status == 'occupied' ? 'danger' : ($room->status == 'reserved' ? 'warning' : 'secondary')) }}">
                            {{ __('models.' . $room->status) }}
                        </span>
                    </p>
                </div>

                <div class="mb-3">
                    <label class="text-muted">{{ __('models.description') }}</label>
                    <p class="mb-0"><strong>{{ $room->description ?? 'N/A' }}</strong></p>
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
                <a href="{{ route('rooms.edit', $room) }}" class="btn btn-warning w-100 mb-2">
                    <i class="bi bi-pencil"></i> {{ __('messages.edit') }}
                </a>
                <form action="{{ route('rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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

@extends('layouts.app')

@section('title', __('messages.add_new') . ' ' . __('messages.reservations'))

@section('content')
<div class="page-header">
    <a href="{{ route('reservations.index') }}" class="btn btn-link">
        <i class="bi bi-arrow-left"></i> {{ __('messages.back') ?? 'Back' }}
    </a>
    <h1><i class="bi bi-calendar-plus"></i> {{ __('messages.add_new') }} {{ __('messages.reservations') }}</h1>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="guest_id" class="form-label">{{ __('messages.guests') }}</label>
                            <select class="form-select @error('guest_id') is-invalid @enderror" id="guest_id" name="guest_id" required>
                                <option value="">{{ __('ui.select') }}</option>
                                @foreach($guests as $guest)
                                    <option value="{{ $guest->id }}" {{ old('guest_id') == $guest->id ? 'selected' : '' }}>
                                        {{ $guest->first_name }} {{ $guest->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('guest_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="room_id" class="form-label">{{ __('messages.rooms') }}</label>
                            <select class="form-select @error('room_id') is-invalid @enderror" id="room_id" name="room_id" required>
                                <option value="">{{ __('ui.select') }}</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->room_number }} ({{ __('models.' . $room->room_type) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="check_in_date" class="form-label">{{ __('models.check_in_date') }}</label>
                            <input type="date" class="form-control @error('check_in_date') is-invalid @enderror" id="check_in_date" name="check_in_date" value="{{ old('check_in_date') }}" required>
                            @error('check_in_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="check_out_date" class="form-label">{{ __('models.check_out_date') }}</label>
                            <input type="date" class="form-control @error('check_out_date') is-invalid @enderror" id="check_out_date" name="check_out_date" value="{{ old('check_out_date') }}" required>
                            @error('check_out_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="number_of_guests" class="form-label">{{ __('models.number_of_guests') }}</label>
                            <input type="number" class="form-control @error('number_of_guests') is-invalid @enderror" id="number_of_guests" name="number_of_guests" value="{{ old('number_of_guests') }}" min="1" max="10" required>
                            @error('number_of_guests')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">{{ __('models.status') }}</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">{{ __('ui.select') }}</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>{{ __('models.pending') }}</option>
                                <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>{{ __('models.confirmed') }}</option>
                                <option value="checked_in" {{ old('status') == 'checked_in' ? 'selected' : '' }}>{{ __('models.checked_in') }}</option>
                                <option value="checked_out" {{ old('status') == 'checked_out' ? 'selected' : '' }}>{{ __('models.checked_out') }}</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>{{ __('models.cancelled') }}</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">{{ __('models.notes') }}</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="4">{{ old('notes') }}</textarea>
                        @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> {{ __('messages.save') }}
                        </button>
                        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                            {{ __('messages.cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', __('messages.add_new') . ' ' . __('messages.rooms'))

@section('content')
<div class="page-header">
    <a href="{{ route('rooms.index') }}" class="btn btn-link">
        <i class="bi bi-arrow-left"></i> {{ __('messages.back') ?? 'Back' }}
    </a>
    <h1><i class="bi bi-door-closed"></i> {{ __('messages.add_new') }} {{ __('messages.rooms') }}</h1>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('rooms.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="room_number" class="form-label">{{ __('models.room_number') }}</label>
                            <input type="text" class="form-control @error('room_number') is-invalid @enderror" id="room_number" name="room_number" value="{{ old('room_number') }}" required>
                            @error('room_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="room_type" class="form-label">{{ __('models.room_type') }}</label>
                            <select class="form-select @error('room_type') is-invalid @enderror" id="room_type" name="room_type" required>
                                <option value="">{{ __('ui.select') }}</option>
                                <option value="single" {{ old('room_type') == 'single' ? 'selected' : '' }}>{{ __('models.single') }}</option>
                                <option value="double" {{ old('room_type') == 'double' ? 'selected' : '' }}>{{ __('models.double') }}</option>
                                <option value="suite" {{ old('room_type') == 'suite' ? 'selected' : '' }}>{{ __('models.suite') }}</option>
                                <option value="deluxe" {{ old('room_type') == 'deluxe' ? 'selected' : '' }}>{{ __('models.deluxe') }}</option>
                            </select>
                            @error('room_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="capacity" class="form-label">{{ __('models.capacity') }}</label>
                            <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity') }}" min="1" max="10" required>
                            @error('capacity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price_per_night" class="form-label">{{ __('models.price_per_night') }}</label>
                            <input type="number" class="form-control @error('price_per_night') is-invalid @enderror" id="price_per_night" name="price_per_night" value="{{ old('price_per_night') }}" min="0" step="0.01" required>
                            @error('price_per_night')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">{{ __('models.status') }}</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="">{{ __('ui.select') }}</option>
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>{{ __('models.available') }}</option>
                            <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>{{ __('models.occupied') }}</option>
                            <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>{{ __('models.maintenance') }}</option>
                            <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>{{ __('models.reserved') }}</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('models.description') }}</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> {{ __('messages.save') }}
                        </button>
                        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">
                            {{ __('messages.cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

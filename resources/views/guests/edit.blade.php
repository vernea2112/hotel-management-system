@extends('layouts.app')

@section('title', __('messages.edit') . ' ' . __('messages.guests'))

@section('content')
<div class="page-header">
    <a href="{{ route('guests.index') }}" class="btn btn-link">
        <i class="bi bi-arrow-left"></i> {{ __('messages.back') ?? 'Back' }}
    </a>
    <h1><i class="bi bi-pencil"></i> {{ __('messages.edit') }} {{ __('messages.guests') }}</h1>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('guests.update', $guest) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">{{ __('models.first_name') }}</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $guest->first_name) }}" required>
                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">{{ __('models.last_name') }}</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $guest->last_name) }}" required>
                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">{{ __('models.email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $guest->email) }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">{{ __('models.phone') }}</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $guest->phone) }}" required>
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">{{ __('models.address') }}</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $guest->address) }}">
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">{{ __('models.city') }}</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $guest->city) }}">
                            @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label">{{ __('models.country') }}</label>
                            <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country', $guest->country) }}">
                            @error('country')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="document_id" class="form-label">{{ __('models.document_id') }}</label>
                            <input type="text" class="form-control @error('document_id') is-invalid @enderror" id="document_id" name="document_id" value="{{ old('document_id', $guest->document_id) }}" required>
                            @error('document_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="document_type" class="form-label">{{ __('models.document_type') }}</label>
                            <select class="form-select @error('document_type') is-invalid @enderror" id="document_type" name="document_type" required>
                                <option value="passport" {{ old('document_type', $guest->document_type) == 'passport' ? 'selected' : '' }}>Passport</option>
                                <option value="cpf" {{ old('document_type', $guest->document_type) == 'cpf' ? 'selected' : '' }}>CPF</option>
                                <option value="rg" {{ old('document_type', $guest->document_type) == 'rg' ? 'selected' : '' }}>RG</option>
                                <option value="driver_license" {{ old('document_type', $guest->document_type) == 'driver_license' ? 'selected' : '' }}>Driver License</option>
                            </select>
                            @error('document_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> {{ __('messages.save') }}
                        </button>
                        <a href="{{ route('guests.index') }}" class="btn btn-secondary">
                            {{ __('messages.cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

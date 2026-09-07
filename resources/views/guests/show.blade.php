@extends('layouts.app')

@section('title', __('messages.guests'))

@section('content')
<div class="page-header">
    <a href="{{ route('guests.index') }}" class="btn btn-link">
        <i class="bi bi-arrow-left"></i> {{ __('messages.back') ?? 'Back' }}
    </a>
    <h1><i class="bi bi-person-badge"></i> {{ $guest->first_name }} {{ $guest->last_name }}</h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('messages.guest_details') ?? 'Guest Details' }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.first_name') }}</label>
                        <p class="mb-0"><strong>{{ $guest->first_name }}</strong></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.last_name') }}</label>
                        <p class="mb-0"><strong>{{ $guest->last_name }}</strong></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.email') }}</label>
                        <p class="mb-0"><strong>{{ $guest->email }}</strong></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.phone') }}</label>
                        <p class="mb-0"><strong>{{ $guest->phone }}</strong></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.city') }}</label>
                        <p class="mb-0"><strong>{{ $guest->city ?? 'N/A' }}</strong></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.country') }}</label>
                        <p class="mb-0"><strong>{{ $guest->country ?? 'N/A' }}</strong></p>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="text-muted">{{ __('models.address') }}</label>
                    <p class="mb-0"><strong>{{ $guest->address ?? 'N/A' }}</strong></p>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.document_id') }}</label>
                        <p class="mb-0"><strong>{{ $guest->document_id }}</strong></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">{{ __('models.document_type') }}</label>
                        <p class="mb-0"><strong>{{ ucfirst($guest->document_type) }}</strong></p>
                    </div>
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
                <a href="{{ route('guests.edit', $guest) }}" class="btn btn-warning w-100 mb-2">
                    <i class="bi bi-pencil"></i> {{ __('messages.edit') }}
                </a>
                <form action="{{ route('guests.destroy', $guest) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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

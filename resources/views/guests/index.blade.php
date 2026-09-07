@extends('layouts.app')

@section('title', __('messages.guests'))

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1><i class="bi bi-people"></i> {{ __('messages.guests') }}</h1>
    </div>
    <a href="{{ route('guests.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> {{ __('messages.add_new') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($guests->count())
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('models.first_name') }}</th>
                            <th>{{ __('models.email') }}</th>
                            <th>{{ __('models.phone') }}</th>
                            <th>{{ __('models.country') }}</th>
                            <th>{{ __('models.document_id') }}</th>
                            <th>{{ __('messages.action') ?? 'Action' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guests as $guest)
                            <tr>
                                <td><strong>{{ $guest->first_name }} {{ $guest->last_name }}</strong></td>
                                <td>{{ $guest->email }}</td>
                                <td>{{ $guest->phone }}</td>
                                <td>{{ $guest->country }}</td>
                                <td>{{ $guest->document_id }}</td>
                                <td>
                                    <a href="{{ route('guests.show', $guest) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('guests.edit', $guest) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('guests.destroy', $guest) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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
                {{ $guests->links('pagination::bootstrap-5') }}
            </div>
        @else
            <p class="text-muted text-center py-4">{{ __('messages.no_results') }}</p>
        @endif
    </div>
</div>
@endsection

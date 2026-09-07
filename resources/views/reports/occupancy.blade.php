@extends('layouts.app')

@section('title', __('messages.reports'))

@section('content')
<div class="page-header">
    <h1><i class="bi bi-graph-up"></i> {{ __('models.occupancy_rate') }}</h1>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('reports.occupancy') }}" class="d-flex gap-2 align-items-end">
                    <div class="flex-grow-1">
                        <label for="date" class="form-label">{{ __('models.check_in_date') }}</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $date }}">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> {{ __('messages.search') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body text-center">
                <h2 class="text-primary mb-3">{{ number_format($occupancyRate, 2) }}%</h2>
                <p class="text-muted">{{ __('models.occupancy_rate') }} on {{ $date }}</p>
                <div class="progress" style="height: 30px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $occupancyRate }}%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">{{ __('ui.occupancy_summary') ?? 'Occupancy Summary' }}</h5>
                <p><strong>Status:</strong> 
                    @if($occupancyRate >= 80)
                        <span class="badge bg-danger">High</span>
                    @elseif($occupancyRate >= 50)
                        <span class="badge bg-warning">Medium</span>
                    @else
                        <span class="badge bg-success">Low</span>
                    @endif
                </p>
                <p class="text-muted mb-0">Report generated for {{ $date }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

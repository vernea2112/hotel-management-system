@extends('layouts.app')

@section('title', __('messages.billing'))

@section('content')
<div class="page-header">
    <h1><i class="bi bi-credit-card"></i> {{ __('messages.billing') }}</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('messages.process_payment') ?? 'Process Payment' }}</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Payment processing module ready for integration with payment gateways (Stripe, PayPal, etc.)
                </div>
                <p class="text-muted">This section will handle all payment processing for guest reservations.</p>
            </div>
        </div>
    </div>
</div>
@endsection

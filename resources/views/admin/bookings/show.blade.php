@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Booking</h2>

    <div class="card shadow-sm" style="max-width:800px; margin:auto;">
        <div class="card-header">
            <h5 class="mb-0">Booking #{{ $booking->booking_code }}</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Customer Information</h6>
                    <p><strong>Name:</strong> {{ $booking->customer_name }}</p>
                    <p><strong>Phone:</strong> {{ $booking->customer_phone }}</p>
                    <p><strong>Email:</strong> {{ $booking->customer_email ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <h6>Visit Details</h6>
                    <p><strong>Date:</strong> {{ $booking->visit_date->format('d M Y') }}</p>
                    <p><strong>Time:</strong> {{ $booking->visit_time }}</p>
                    <p><strong>Payment Method:</strong>
                        @if($booking->payment_method == 'tempat')
                            Bayar di Tempat
                        @elseif($booking->payment_method == 'transfer')
                            Transfer
                        @else
                            QRIS
                        @endif
                    </p>
                </div>
            </div>

            <hr>

            <h6>Tickets</h6>
            @if($booking->tickets)
                <ul class="list-group mb-3">
                    @foreach($booking->tickets as $ticket)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $ticket['type'] }}</span>
                            <span>{{ $ticket['quantity'] }} orang</span>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if($booking->menu_items)
                <h6>Menu Items</h6>
                <ul class="list-group mb-3">
                    @foreach($booking->menu_items as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Menu ID: {{ $item['id'] }}</span>
                            <span>{{ $item['quantity'] }} pcs</span>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if($booking->notes)
                <h6>Notes</h6>
                <p>{{ $booking->notes }}</p>
            @endif

            <p><strong>Terms Agreed:</strong> {{ $booking->agree_terms ? 'Yes' : 'No' }}</p>
            <p><strong>Created At:</strong> {{ $booking->created_at->format('d M Y H:i') }}</p>
        </div>

        <div class="card-footer bg-white border-0 d-flex gap-2">
            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">
                Edit
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary btn-sm">
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection

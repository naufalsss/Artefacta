@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h2 class="mb-4">
            <i class="fas fa-calendar-check text-primary"></i> Manage Bookings
        </h2>
    </div>
</div>

{{-- SEARCH --}}
<form method="GET" action="{{ route('admin.bookings.index') }}" class="mb-4 d-flex gap-2">
    <input type="text" name="search" class="form-control" placeholder="Cari booking..." value="{{ request('search') }}">
    <button type="submit" class="btn btn-secondary">Cari</button>
</form>

{{-- BOOKINGS TABLE --}}
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Booking Code</th>
                        <th>Customer</th>
                        <th>Visit Date</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                    <tr>
                        <td>
                            <strong>{{ $booking->booking_code }}</strong>
                        </td>
                        <td>
                            <div>{{ $booking->customer_name }}</div>
                            <small class="text-muted">{{ $booking->customer_phone }}</small>
                        </td>
                        <td>
                            <div>{{ $booking->visit_date->format('d M Y') }}</div>
                            <small class="text-muted">{{ $booking->visit_time }}</small>
                        </td>
                        <td>
                            @if($booking->payment_method == 'tempat')
                                <span class="badge bg-info">Bayar di Tempat</span>
                            @elseif($booking->payment_method == 'transfer')
                                <span class="badge bg-primary">Transfer</span>
                            @else
                                <span class="badge bg-success">QRIS</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus booking ini?')" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            <i class="fas fa-calendar-times fa-2x mb-2"></i>
                            <br>Belum ada booking
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- PAGINATION --}}
<div class="mt-4">
    {{ $bookings->links() }}
</div>
@endsection

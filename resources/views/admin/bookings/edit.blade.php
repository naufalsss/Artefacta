@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Booking</h2>

    <div class="card shadow-sm" style="max-width:800px; margin:auto;">
        <div class="card-header">
            <h5 class="mb-0">Edit Booking #{{ $booking->booking_code }}</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <h6>Customer Information</h6>

                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                   name="customer_name" id="customer_name"
                                   value="{{ old('customer_name', $booking->customer_name) }}" required>
                            @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="customer_phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('customer_phone') is-invalid @enderror"
                                   name="customer_phone" id="customer_phone"
                                   value="{{ old('customer_phone', $booking->customer_phone) }}" required>
                            @error('customer_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="customer_email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('customer_email') is-invalid @enderror"
                                   name="customer_email" id="customer_email"
                                   value="{{ old('customer_email', $booking->customer_email) }}">
                            @error('customer_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6>Visit Details</h6>

                        <div class="mb-3">
                            <label for="visit_date" class="form-label">Visit Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('visit_date') is-invalid @enderror"
                                   name="visit_date" id="visit_date"
                                   value="{{ old('visit_date', $booking->visit_date->format('Y-m-d')) }}" required>
                            @error('visit_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="visit_time" class="form-label">Visit Time <span class="text-danger">*</span></label>
                            <input type="time" class="form-control @error('visit_time') is-invalid @enderror"
                                   name="visit_time" id="visit_time"
                                   value="{{ old('visit_time', $booking->visit_time) }}" required>
                            @error('visit_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method <span class="text-danger">*</span></label>
                            <select name="payment_method" id="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                                <option value="tempat" {{ old('payment_method', $booking->payment_method) == 'tempat' ? 'selected' : '' }}>Bayar di Tempat</option>
                                <option value="transfer" {{ old('payment_method', $booking->payment_method) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                <option value="qris" {{ old('payment_method', $booking->payment_method) == 'qris' ? 'selected' : '' }}>QRIS</option>
                            </select>
                            @error('payment_method') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tickets" class="form-label">Tickets <span class="text-danger">*</span></label>
                    <textarea name="tickets" id="tickets" rows="4" class="form-control @error('tickets') is-invalid @enderror" placeholder='[{"type": "Adult", "quantity": 2}, {"type": "Child", "quantity": 1}]' required>{{ old('tickets', json_encode($booking->tickets, JSON_PRETTY_PRINT)) }}</textarea>
                    <small class="form-text text-muted">Format: JSON array of objects with "type" and "quantity" fields</small>
                    @error('tickets') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="menu_items" class="form-label">Menu Items</label>
                    <textarea name="menu_items" id="menu_items" rows="4" class="form-control @error('menu_items') is-invalid @enderror" placeholder='[{"id": 1, "quantity": 2}, {"id": 3, "quantity": 1}]'>{{ old('menu_items', $booking->menu_items ? json_encode($booking->menu_items, JSON_PRETTY_PRINT) : '') }}</textarea>
                    <small class="form-text text-muted">Format: JSON array of objects with "id" and "quantity" fields (optional)</small>
                    @error('menu_items') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $booking->notes) }}</textarea>
                    @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="hidden" name="agree_terms" value="0">
                    <input type="checkbox" class="form-check-input @error('agree_terms') is-invalid @enderror"
                           name="agree_terms" id="agree_terms" value="1"
                           {{ old('agree_terms', $booking->agree_terms) ? 'checked' : '' }}>
                    <label class="form-check-label" for="agree_terms">Terms Agreed</label>
                    @error('agree_terms') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update Booking</button>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

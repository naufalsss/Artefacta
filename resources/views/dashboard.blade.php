@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Artifacts</h5>
                <p class="display-6">{{ $artifactsCount }}</p>
                <a href="{{ route('admin.artifacts.index') }}" class="btn btn-modern btn-primary">Manage Artifacts</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Users</h5>
                <p class="display-6">{{ $usersCount }}</p>
                <a href="{{ route('admin.users.index') }}" class="btn btn-modern btn-primary">Manage Users</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Galleries</h5>
                <p class="display-6">{{ $galleriesCount }}</p>
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-modern btn-primary">Manage Galleries</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Menu</h5>
                <p class="display-6">{{ $menusCount }}</p>
                <a href="{{ route('admin.menus.index') }}" class="btn btn-modern btn-primary">Manage Menus</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Available Menus</h5>
                <p class="display-6">{{ $availableMenus }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Signature Menus</h5>
                <p class="display-6">{{ $signatureMenus }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Bookings</h5>
                <p class="display-6">{{ $bookingsCount }}</p>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-modern btn-primary">Manage Bookings</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Today's Bookings</h5>
                <p class="display-6">{{ $todayBookings }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Tickets Sold</h5>
                <p class="display-6">{{ $totalTickets }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

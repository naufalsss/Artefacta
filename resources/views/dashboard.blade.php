@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Artifacts</h5>
                <p class="display-6">{{ $artifactsCount }}</p>
                <a href="{{ route('artifacts.index') }}" class="btn btn-modern btn-primary">Manage Artifacts</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Users</h5>
                <p class="display-6">{{ $usersCount }}</p>
                <a href="{{ route('users.index') }}" class="btn btn-modern btn-primary">Manage Users</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Galleries</h5>
                <p class="display-6">{{ $galleriesCount }}</p>
                <a href="{{ route('galleries.index') }}" class="btn btn-modern btn-primary">Manage Galleries</a>
            </div>
        </div>
    </div>
</div>
@endsection

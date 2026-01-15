@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">
                    <i class="fas fa-user"></i> User Details
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong><i class="fas fa-id-badge"></i> ID:</strong> {{ $user->id }}</p>
                        <p><strong><i class="fas fa-user"></i> Name:</strong> {{ $user->name }}</p>
                        <p><strong><i class="fas fa-envelope"></i> Email:</strong> {{ $user->email }}</p>
                        <p><strong><i class="fas fa-venus-mars"></i> Gender:</strong> {{ $user->jenis_kelamin }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong><i class="fas fa-birthday-cake"></i> Age:</strong> {{ $user->umur }}</p>
                        <p><strong><i class="fas fa-user-tag"></i> Status:</strong> {{ $user->status }}</p>
                        <p><strong><i class="fas fa-shield-alt"></i> Role:</strong>
                            <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'secondary' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </p>
                        <p><strong><i class="fas fa-calendar"></i> Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Users
                </a>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit User
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
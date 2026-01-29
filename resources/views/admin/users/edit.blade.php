@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">
                    <i class="fas fa-edit"></i> Edit User
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-user"></i> Name
                            </label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i> Email
                            </label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i> Password (leave blank to keep current)
                            </label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin" class="form-label">
                                <i class="fas fa-venus-mars"></i> Gender
                            </label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Male</option>
                                <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="umur" class="form-label">
                                <i class="fas fa-birthday-cake"></i> Age
                            </label>
                            <input type="number" name="umur" value="{{ $user->umur }}" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">
                                <i class="fas fa-user-tag"></i> Status
                            </label>
                            <select name="status" class="form-select" required>
                                <option value="Pelajar" {{ $user->status == 'Pelajar' ? 'selected' : '' }}>Student</option>
                                <option value="Mahasiswa" {{ $user->status == 'Mahasiswa' ? 'selected' : '' }}>College Student</option>
                                <option value="Pekerja" {{ $user->status == 'Pekerja' ? 'selected' : '' }}>Worker</option>
                                <option value="Pensiunan" {{ $user->status == 'Pensiunan' ? 'selected' : '' }}>Retired</option>
                                <option value="Lainnya" {{ $user->status == 'Lainnya' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="role" class="form-label">
                                <i class="fas fa-shield-alt"></i> Role
                            </label>
                            <select name="role" class="form-select" required>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-warning btn-modern">
                            <i class="fas fa-save"></i> Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
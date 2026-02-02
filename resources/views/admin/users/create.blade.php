@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-user-plus"></i> Create New User
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-user"></i> Name
                            </label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i> Email
                            </label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i> Password
                            </label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin" class="form-label">
                                <i class="fas fa-venus-mars"></i> Gender
                            </label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="">Choose...</option>
                                <option value="Laki-laki">Male</option>
                                <option value="Perempuan">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="umur" class="form-label">
                                <i class="fas fa-birthday-cake"></i> Age
                            </label>
                            <input type="number" name="umur" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">
                                <i class="fas fa-user-tag"></i> Status
                            </label>
                            <select name="status" class="form-select" required>
                                <option value="">Choose...</option>
                                <option value="Pelajar">Student</option>
                                <option value="Mahasiswa">College Student</option>
                                <option value="Pekerja">Worker</option>
                                <option value="Pensiunan">Retired</option>
                                <option value="Lainnya">Other</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-toggle-on"></i> Keaktifan Akun
                            </label>

                            <div class="d-flex gap-3 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="keaktifan" id="aktif" >
                                    <label class="form-check-label" for="aktif">
                                        Aktif
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="keaktifan" id="nonaktif" >
                                    <label class="form-check-label" for="nonaktif">
                                        Non Aktif
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 mb-3">
                            <label for="role" class="form-label">
                                <i class="fas fa-shield-alt"></i> Role
                            </label>
                            <select name="role" class="form-select" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-success btn-modern">
                            <i class="fas fa-save"></i> Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
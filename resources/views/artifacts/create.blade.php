@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">
                    <i class="fas fa-plus"></i> Create New Artifact
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('artifacts.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="fas fa-tag"></i> Name
                        </label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left"></i> Description
                        </label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('artifacts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-success btn-modern">
                            <i class="fas fa-save"></i> Create Artifact
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
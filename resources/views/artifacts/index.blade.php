@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="mb-4">
            <i class="fas fa-box text-primary"></i> Manage Artifacts
        </h2>
        <a href="{{ route('artifacts.create') }}" class="btn btn-primary btn-modern">
            <i class="fas fa-plus"></i> Add New Artifact
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row">
    @foreach($artifacts as $artifact)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-archive text-secondary"></i> {{ $artifact->name }}
                </h5>
                <p class="card-text text-muted">
                    {{ Str::limit($artifact->description, 100) }}
                </p>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('artifacts.show', $artifact) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <a href="{{ route('artifacts.edit', $artifact) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('artifacts.destroy', $artifact) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-footer text-muted">
                <small>Created: {{ $artifact->created_at->format('d M Y') }}</small>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($artifacts->isEmpty())
<div class="text-center mt-5">
    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
    <h4 class="text-muted">No artifacts found</h4>
    <p class="text-muted">Start by adding your first artifact!</p>
</div>
@endif
@endsection
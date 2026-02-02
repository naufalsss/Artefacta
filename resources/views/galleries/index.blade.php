@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="mb-4">
            <i class="fas fa-images text-primary"></i> Manage Galleries
        </h2>
        <a href="{{ route('galleries.create') }}" class="btn btn-primary btn-modern">
            <i class="fas fa-plus"></i> Add New Gallery Item
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
    @foreach($galleries as $gallery)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            @if($gallery->image_path)
            <div class="card-img-top" style="height: 200px; overflow: hidden;">
                <img 
                    src="{{ Storage::url($gallery->image_path) }}" 
                    alt="{{ $gallery->title }}" 
                    style="width: 100%; height: 100%; object-fit: cover;"
                >
            </div>
            @else
            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                <i class="fas fa-image text-muted fa-3x"></i>
            </div>
            @endif
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-picture-o text-secondary"></i> {{ $gallery->title }}
                </h5>
                <p class="card-text text-muted">
                    {{ Str::limit($gallery->description, 80) }}
                </p>
                @if($gallery->artifact)
                <p class="card-text small">
                    <strong>Artifact:</strong> {{ $gallery->artifact->name }}
                </p>
                @endif
                <p class="card-text small">
                    <strong>Status:</strong> 
                    @if($gallery->is_published)
                        <span class="badge bg-success">Published</span>
                    @else
                        <span class="badge bg-secondary">Draft</span>
                    @endif
                </p>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.galleries.show', $gallery) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admni.galleries.destroy', $gallery) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-footer text-muted">
                <small>Created: {{ $gallery->created_at->format('d M Y') }}</small>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($galleries->isEmpty())
<div class="text-center mt-5">
    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
    <h4 class="text-muted">No gallery items found</h4>
    <p class="text-muted">Start by adding your first gallery item!</p>
</div>
@endif

<div class="row mt-4">
    <div class="col-12">
        {{ $galleries->links() }}
    </div>
</div>
@endsection
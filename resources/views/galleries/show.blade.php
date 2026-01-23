@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="mb-4">
            <i class="fas fa-image text-primary"></i> {{ $gallery->title }}
        </h2>
        <a href="{{ route('galleries.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back to Gallery
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            @if($gallery->image_path)
            <div class="card-img-top" style="overflow: hidden; max-height: 500px;">
                <img src="{{ asset('storage/'.$gallery->image_path) }}" alt="{{ $gallery->title }}" 
                    style="width: 100%; height: auto; object-fit: contain;">
            </div>
            @else
            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 400px;">
                <i class="fas fa-image text-muted fa-5x"></i>
            </div>
            @endif
            <div class="card-body">
                <p class="card-text">{{ $gallery->description }}</p>
                
                @if($gallery->artifact)
                <div class="alert alert-info mb-3">
                    <strong>Associated Artifact:</strong> {{ $gallery->artifact->name }}
                </div>
                @endif
                
                <div class="alert alert-secondary">
                    <strong>Status:</strong> 
                    @if($gallery->is_published)
                        <span class="badge bg-success">Published</span>
                    @else
                        <span class="badge bg-secondary">Draft</span>
                    @endif
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('galleries.edit', $gallery) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('galleries.destroy', $gallery) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-footer text-muted">
                <small>Created: {{ $gallery->created_at->format('d M Y H:i') }} | Updated: {{ $gallery->updated_at->format('d M Y H:i') }}</small>
            </div>
        </div>
    </div>
</div>
@endsection
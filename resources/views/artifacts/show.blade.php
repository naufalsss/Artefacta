@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">
                    <i class="fas fa-eye"></i> Artifact Details
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong><i class="fas fa-id-badge"></i> ID:</strong> {{ $artifact->id }}</p>
                        <p><strong><i class="fas fa-tag"></i> Name:</strong> {{ $artifact->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong><i class="fas fa-calendar"></i> Created:</strong> {{ $artifact->created_at->format('d M Y H:i') }}</p>
                        <p><strong><i class="fas fa-calendar-check"></i> Updated:</strong> {{ $artifact->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
                <div class="mt-3">
                    <strong><i class="fas fa-align-left"></i> Description:</strong>
                    <p class="mt-2">{{ $artifact->description ?: 'No description provided.' }}</p>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('artifacts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Artifacts
                </a>
                <a href="{{ route('artifacts.edit', $artifact) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Artifact
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
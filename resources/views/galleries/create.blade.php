@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="mb-4">
            <i class="fas fa-plus-circle text-primary"></i> Create Gallery Item
        </h2>
    </div>
</div>

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle"></i> <strong>Please fix the following errors:</strong>
    <ul class="mb-0 mt-2">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row">
    <div class="col-md-8">
        <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
            @include('galleries._form')
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary btn-modern">
                    <i class="fas fa-save"></i> Create Gallery Item
                </button>
                <a href="{{ route('galleries.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
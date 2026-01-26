@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Menu Detail</h2>

    <div class="card shadow-sm" style="max-width:800px;">
        <img
            src="{{ asset('storage/'.$menu->image) }}"
            class="card-img-top"
            style="height:300px; object-fit:cover;"
        >

        <div class="card-body">
            <h4>{{ $menu->name }}</h4>

            <p class="text-muted">{{ $menu->description }}</p>

            <p><strong>Category:</strong> {{ $menu->category }}</p>
            <p><strong>Price:</strong> Rp {{ number_format($menu->price) }}</p>

            @if($menu->is_signature)
                <span class="badge bg-warning text-dark">⭐ Signature</span>
            @endif

            @if($menu->is_available)
                <span class="badge bg-success">Available</span>
            @else
                <span class="badge bg-secondary">Unavailable</span>
            @endif
        </div>

        <div class="card-footer bg-white border-0 d-flex gap-2">
            <a href="{{ route('admin.menus.edit',$menu->id) }}" class="btn btn-warning btn-sm">
                Edit
            </a>
            <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary btn-sm">
                Back
            </a>
        </div>
    </div>
</div>
@endsection

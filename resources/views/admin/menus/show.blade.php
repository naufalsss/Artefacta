@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Menu</h2>

    <div class="card shadow-sm" style="max-width:800px; margin:auto;">
        {{-- Gambar Menu --}}
        @if($menu->image)
            <img src="{{ asset('storage/'.$menu->image) }}"
                 class="card-img-top"
                 style="height:300px; object-fit:cover;">
        @else
            <img src="{{ asset('foto/square.png') }}"
                 class="card-img-top"
                 style="height:300px; object-fit:cover;">
        @endif

        <div class="card-body">
            <h4 class="card-title">{{ $menu->name }}</h4>

            <p class="text-muted">{{ $menu->description ?? '-' }}</p>

            <p><strong>Category:</strong> {{ $menu->category->name ?? '-' }}</p>
            <p><strong>Price:</strong> Rp {{ number_format($menu->price) }}</p>

            {{-- Badges --}}
            @if($menu->is_signature)
                <span class="badge bg-warning text-dark mb-1">⭐ Signature</span>
            @endif

            @if($menu->is_available)
                <span class="badge bg-success mb-1">Available</span>
            @else
                <span class="badge bg-secondary mb-1">Unavailable</span>
            @endif
        </div>

        <div class="card-footer bg-white border-0 d-flex gap-2">
            <a href="{{ route('menus.edit',$menu->id) }}" class="btn btn-warning btn-sm">
                Edit
            </a>
            <a href="{{ route('menus.index') }}" class="btn btn-secondary btn-sm">
                Back
            </a>
        </div>
    </div>
</div>
@endsection

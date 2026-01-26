@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="mb-4">
            <i class="fas fa-images text-primary"></i> Manage Menus
        </h2>
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary btn-modern">
            <i class="fas fa-plus"></i> Add New Menu
        </a>
    </div>
</div>

{{-- SEARCH --}}
<form method="GET" action="{{ route('admin.menus.index') }}" class="mb-4 d-flex gap-2">
    <input type="text" name="search" class="form-control" placeholder="Cari menu..." value="{{ request('search') }}">
    <button type="submit" class="btn btn-secondary">Cari</button>
</form>

{{-- TABLE MENU --}}
<div class="row g-4">
    @foreach ($menus as $menu)
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">

            {{-- IMAGE --}}
            <img src="{{ $menu->image_path ? asset('storage/'.$menu->image_path) : asset('img/placeholder.png') }}"
                 class="card-img-top"
                 style="height:200px; object-fit:cover;">

            {{-- CARD BODY --}}
            <div class="card-body">
                <h5 class="card-title">{{ $menu->name }}</h5>
                <p class="card-text text-muted mb-2">{{ $menu->description ?? '-' }}</p>
                <p class="mb-1"><strong>Category:</strong> {{ ucfirst($menu->category) }}</p>
                <p class="mb-2"><strong>Price:</strong> Rp {{ number_format($menu->price) }}</p>

                {{-- BADGES --}}
                @if($menu->is_signature)
                    <span class="badge bg-warning text-dark mb-1">⭐ Signature</span>
                @endif
                @if($menu->is_available)
                    <span class="badge bg-success mb-1">Available</span>
                @else
                    <span class="badge bg-secondary mb-1">Unavailable</span>
                @endif
            </div>

            {{-- CARD FOOTER / ACTIONS --}}
            <div class="card-footer bg-white border-0 d-flex gap-2">
                <a href="{{ route('admin.menus.show',$menu->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('admin.menus.edit',$menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.menus.destroy',$menu->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus menu?')" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- PAGINATION --}}
<div class="mb-5">
    {{ $menus->links() }}
</div>

{{-- SIGNATURE MENUS --}}
<h3 class="mb-3">⭐ Signature Menus</h3>
<div class="row g-4 mb-5">
    @foreach ($signatureMenus as $menu)
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">

            {{-- IMAGE --}}
            <img src="{{ $menu->image_path ? asset('storage/'.$menu->image_path) : asset('img/placeholder.png') }}"
                 class="card-img-top"
                 style="height:200px; object-fit:cover;">

            {{-- CARD BODY --}}
            <div class="card-body">
                <h5 class="card-title">{{ $menu->name }}</h5>
                <p class="card-text text-muted mb-2">{{ $menu->description ?? '-' }}</p>
                <p class="mb-1"><strong>Category:</strong> {{ ucfirst($menu->category) }}</p>
                <p class="mb-2"><strong>Price:</strong> Rp {{ number_format($menu->price) }}</p>

                {{-- BADGES --}}
                <span class="badge bg-warning text-dark mb-1">⭐ Signature</span>
                @if($menu->is_available)
                    <span class="badge bg-success mb-1">Available</span>
                @else
                    <span class="badge bg-secondary mb-1">Unavailable</span>
                @endif
            </div>

            {{-- CARD FOOTER / ACTIONS --}}
            <div class="card-footer bg-white border-0 d-flex gap-2">
                <a href="{{ route('admin.menus.show',$menu->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('admin.menus.edit',$menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.menus.destroy',$menu->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus menu?')" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- COFFEE MENUS --}}
<h3 class="mb-3">☕ Coffee Menus</h3>
<div class="row g-4 mb-5">
    @foreach ($coffeeMenus as $menu)
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">

            {{-- IMAGE --}}
            <img src="{{ $menu->image_path ? asset('storage/'.$menu->image_path) : asset('img/placeholder.png') }}"
                 class="card-img-top"
                 style="height:200px; object-fit:cover;">

            {{-- CARD BODY --}}
            <div class="card-body">
                <h5 class="card-title">{{ $menu->name }}</h5>
                <p class="card-text text-muted mb-2">{{ $menu->description ?? '-' }}</p>
                <p class="mb-1"><strong>Category:</strong> {{ ucfirst($menu->category) }}</p>
                <p class="mb-2"><strong>Price:</strong> Rp {{ number_format($menu->price) }}</p>

                {{-- BADGES --}}
                @if($menu->is_available)
                    <span class="badge bg-success mb-1">Available</span>
                @else
                    <span class="badge bg-secondary mb-1">Unavailable</span>
                @endif
            </div>

            {{-- CARD FOOTER / ACTIONS --}}
            <div class="card-footer bg-white border-0 d-flex gap-2">
                <a href="{{ route('admin.menus.show',$menu->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('admin.menus.edit',$menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.menus.destroy',$menu->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus menu?')" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

@push('scripts')
<script>
function toggleSignature(id) {
    fetch(`/admin/menus/${id}/toggle-signature`, {
        method: 'PATCH',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    });
}

function toggleAvailable(id) {
    fetch(`/admin/menus/${id}/toggle-available`, {
        method: 'PATCH',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    });
}
</script>
@endpush

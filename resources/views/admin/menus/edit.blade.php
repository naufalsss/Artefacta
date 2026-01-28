@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        {{-- LEFT: Preview Card --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div style="aspect-ratio:4/3; background:#f5f5f5; overflow:hidden;">
                    @if(isset($menu) && $menu->image)
                        <img src="{{ asset('storage/'.$menu->image) }}" class="w-100 h-100" style="object-fit:cover;">
                    @else
                        <div id="cardImagePlaceholder" class="h-100 d-flex justify-content-center align-items-center">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <h5 id="cardTitle">{{ old('name', $menu->name ?? 'Nama Menu') }}</h5>
                    <p id="cardDesc" class="text-muted small">{{ old('description', $menu->description ?? 'Deskripsi menu akan muncul di sini') }}</p>
                    <p><strong>Harga:</strong> Rp <span id="cardPrice">{{ number_format(old('price', $menu->price ?? 0), 0, ',', '.') }}</span></p>
                </div>
            </div>
        </div>

        {{-- RIGHT: Form Input --}}
        <div class="col-md-8">
            {{-- Sesuaikan Route Admin --}}
            <form action="{{ isset($menu) ? route('menus.update', $menu->id) : route('menus.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($menu)) @method('PUT') @endif

                {{-- NAME --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Menu Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" id="name" value="{{ old('name', $menu->name ?? '') }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- PRICE --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                           name="price" id="price" value="{{ old('price', $menu->price ?? '') }}" required>
                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- CATEGORY - Sekarang Mengambil dari Database --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Select category --</option>
                        @foreach(\App\Models\Category::all() as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $menu->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- DESCRIPTION --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $menu->description ?? '') }}</textarea>
                </div>

                {{-- IMAGE --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                    @if(isset($menu) && $menu->image)
                        <div class="mt-2">
                            <small class="text-muted">Current: {{ $menu->image }}</small>
                        </div>
                    @endif
                </div>

                {{-- CHECKBOXES --}}
                <div class="mb-3 form-check">
                    <input type="hidden" name="is_signature" value="0">
                    <input type="checkbox" class="form-check-input" name="is_signature" id="is_signature" value="1"
                           {{ old('is_signature', $menu->is_signature ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_signature">⭐ Signature Menu</label>
                </div>

                <div class="mb-3 form-check">
                    <input type="hidden" name="is_available" value="0">
                    <input type="checkbox" class="form-check-input" name="is_available" id="is_available" value="1"
                           {{ old('is_available', $menu->is_available ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_available">Available</label>
                </div>

                <div class="d-flex gap-2 mb-5">
                    <button type="submit" class="btn btn-primary px-4">{{ isset($menu) ? 'Update' : 'Save' }}</button>
                    <a href="{{ route('menus.index') }}" class="btn btn-secondary px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

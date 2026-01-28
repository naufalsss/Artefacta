@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Menu Baru</h1>

    <div class="card shadow-sm p-4" style="max-width:700px;">
        <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Nama Menu --}}
            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Harga --}}
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="price"
                       class="form-control @error('price') is-invalid @enderror"
                       value="{{ old('price') }}" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" rows="4"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Gambar --}}
            <div class="mb-3">
                <label class="form-label">Foto Menu</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Format: JPG, PNG, JPEG. Maks: 2MB</small>
            </div>

            {{-- Signature --}}
            <div class="form-check mb-2">
                {{-- Pastikan ada value="1" --}}
                <input type="checkbox" name="is_signature" id="is_signature" class="form-check-input" value="1"
                    {{ old('is_signature') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_signature">Signature Menu</label>
            </div>

            {{-- Available --}}
            <div class="form-check mb-4">
                {{-- Value="1" dan default checked karena di DB defaultnya 1 --}}
                <input type="checkbox" name="is_available" id="is_available" class="form-check-input" value="1"
                    {{ old('is_available', '1') == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="is_available">Available</label>
            </div>


            {{-- Buttons --}}
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan Menu</button>
                <a href="{{ route('menus.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<h1>Edit Menu</h1>

<form action="{{ route('admin.menus.update', $menu->id) }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Nama Menu</label><br>
    <input type="text" name="name" value="{{ $menu->name }}" required><br><br>

    <label>Harga</label><br>
    <input type="number" name="price" value="{{ $menu->price }}" required><br><br>

    <label>Deskripsi</label><br>
    <textarea name="description">{{ $menu->description }}</textarea><br><br>

    <label>Kategori</label><br>
    <select name="category" required>
        <option value="Coffee" {{ $menu->category == 'Coffee' ? 'selected' : '' }}>Coffee</option>
        <option value="Non Coffee" {{ $menu->category == 'Non Coffee' ? 'selected' : '' }}>Non Coffee</option>
        <option value="Food" {{ $menu->category == 'Food' ? 'selected' : '' }}>Food</option>
    </select><br><br>

    {{-- IMAGE UPLOAD --}}
    <label>Gambar Menu</label><br>
    <input type="file" name="image"><br><br>

    {{-- PREVIEW IMAGE LAMA + HAPUS IMAGE --}}
    @if ($menu->image)
        <img src="{{ asset('storage/' . $menu->image) }}"
             width="120"
             style="display:block;margin-bottom:10px;">

        <form action="{{ route('admin.menus.deleteImage', $menu->id) }}"
              method="POST"
              onsubmit="return confirm('Hapus gambar ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" style="background:red;color:white;">
                Hapus Gambar
            </button>
        </form>
        <br>
    @endif

    <label>
        <input type="checkbox" name="is_signature" {{ $menu->is_signature ? 'checked' : '' }}>
        Signature Menu
    </label><br>

    <label>
        <input type="checkbox" name="is_available" {{ $menu->is_available ? 'checked' : '' }}>
        Available
    </label><br><br>

    <button type="submit">Update</button>
</form>
@endsection

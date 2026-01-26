@extends('layouts.app')

@section('content')
<h1>Tambah Menu</h1>

    <div class="card shadow-sm p-4" style="max-width:700px;">
        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Nama Menu</label>
                <input type="text" name="name" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description"></textarea>
            </div>

            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="price" required>

            </div>

            <div class="mb-3">
                <label>Kategori</label>
                <select name="category" required>
                    <option value="Coffee">Coffee</option>
                    <option value="Non Coffee">Non Coffee</option>
                    <option value="Food">Food</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Menu</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="is_signature">
                <label class="form-check-label">Signature Menu</label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_available" checked>
                <label class="form-check-label">Available</label>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary">Save</button>
                <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

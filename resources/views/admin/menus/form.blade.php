<div class="col-md-4">
    <div class="card shadow-sm border-0">
        <div style="aspect-ratio:4/3; background:#f5f5f5; overflow:hidden">
            <img id="cardPreviewImage"
                class="w-100 h-100"
                style="object-fit:cover; display:none;">
            <div id="cardImagePlaceholder"
                class="h-100 d-flex justify-content-center align-items-center">
                <i class="fas fa-image fa-3x text-muted"></i>
            </div>
        </div>

        <div class="card-body">
            <h5 id="cardTitle">Nama Menu</h5>
           @csrf

{{-- NAME --}}
<div class="mb-3">
    <label for="name" class="form-label">
        <i class="fas fa-coffee"></i> Menu Name <span class="text-danger">*</span>
    </label>
    <input type="text"
        class="form-control @error('name') is-invalid @enderror"
        name="name"
        id="name"
        value="{{ old('name', $menu->name ?? '') }}"
        required
        placeholder="Enter menu name">

    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- PRICE --}}
<div class="mb-3">
    <label for="price" class="form-label">
        <i class="fas fa-money-bill"></i> Price <span class="text-danger">*</span>
    </label>
    <input type="number"
        class="form-control @error('price') is-invalid @enderror"
        name="price"
        id="price"
        value="{{ old('price', $menu->price ?? '') }}"
        required
        placeholder="Enter price">

    @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- CATEGORY --}}
<div class="mb-3">
    <label for="category" class="form-label">
        <i class="fas fa-list"></i> Category
    </label>
    <select name="category"
        id="category"
        class="form-control @error('category') is-invalid @enderror">
        <option value="">-- Select category --</option>
        <option value="coffee" {{ old('category', $menu->category ?? '') == 'coffee' ? 'selected' : '' }}>Coffee</option>
        <option value="non-coffee" {{ old('category', $menu->category ?? '') == 'non-coffee' ? 'selected' : '' }}>Non Coffee</option>
        <option value="snack" {{ old('category', $menu->category ?? '') == 'snack' ? 'selected' : '' }}>Snack</option>
    </select>

    @error('category')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- DESCRIPTION --}}
<div class="mb-3">
    <label for="description" class="form-label">
        <i class="fas fa-align-left"></i> Description
    </label>
    <textarea
        class="form-control @error('description') is-invalid @enderror"
        name="description"
        id="description"
        rows="4"
        placeholder="Enter menu description">{{ old('description', $menu->description ?? '') }}</textarea>

    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- IMAGE --}}
<div class="mb-3">
    <label for="image" class="form-label">
        <i class="fas fa-image"></i> Image <span class="text-danger">*</span>
    </label>
    <input type="file"
        class="form-control @error('image') is-invalid @enderror"
        name="image"
        id="image"
        accept="image/*">

    <small class="form-text text-muted">
        Max size: 2MB. Formats: JPG, PNG, WEBP
    </small>

    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    {{-- CURRENT IMAGE (SAMA PERSIS STRUKTURNYA) --}}
    @if(!empty($menu->image))
        <div class="mt-3">
            <p class="text-muted">Current image:</p>
            <img
                src="{{ asset('storage/'.$menu->image) }}"
                alt="{{ $menu->name }}"
                style="max-width: 300px; border-radius: 4px;">
        </div>
    @endif
</div>

{{-- SIGNATURE --}}
<div class="mb-3 form-check">
    <input type="checkbox"
        class="form-check-input"
        name="is_signature"
        id="is_signature"
        {{ old('is_signature', $menu->is_signature ?? false) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_signature">
        ⭐ Signature Menu
    </label>
</div>

{{-- AVAILABLE --}}
<div class="mb-3 form-check">
    <input type="checkbox"
        class="form-check-input"
        name="is_available"
        id="is_available"
        {{ old('is_available', $menu->is_available ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_available">
        Available
    </label>
</div> <p id="cardDesc" class="text-muted small">
                Deskripsi menu akan muncul di sini
            </p>
            <p><strong>Harga:</strong> Rp <span id="cardPrice">0</span></p>
        </div>
    </div>
</div>

@csrf

<div class="mb-3">
    <label for="title" class="form-label">
        <i class="fas fa-heading"></i> Title <span class="text-danger">*</span>
    </label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" 
        value="{{ old('title', $gallery->title ?? '') }}" required placeholder="Enter gallery item title">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="artifact_id" class="form-label">
        <i class="fas fa-archive"></i> Associated Artifact
    </label>
    <select class="form-control @error('artifact_id') is-invalid @enderror" name="artifact_id" id="artifact_id">
        <option value="">-- Select an artifact --</option>
        @foreach($artifacts as $artifact)
            <option value="{{ $artifact->id }}" 
                {{ old('artifact_id', $gallery->artifact_id ?? '') == $artifact->id ? 'selected' : '' }}>
                {{ $artifact->name }}
            </option>
        @endforeach
    </select>
    @error('artifact_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">
        <i class="fas fa-align-left"></i> Description
    </label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" 
        rows="4" placeholder="Enter gallery item description">{{ old('description', $gallery->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">
        <i class="fas fa-image"></i> Image <span class="text-danger">*</span>
    </label>
    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" 
        accept="image/*" placeholder="Upload image">
    <small class="form-text text-muted">Max size: 2MB. Formats: JPG, PNG, GIF, WebP</small>
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    
    @if(!empty($gallery->image_path))
    <div class="mt-3">
        <p class="text-muted">Current image:</p>
        <img src="{{ asset('storage/'.$gallery->image_path) }}" alt="{{ $gallery->title }}" style="max-width: 300px; border-radius: 4px;">
        <button type="button" class="btn btn-sm btn-info ms-2" id="editCurrentImage" style="margin-top: -30px; position: relative; z-index: 10;">
            <i class="fas fa-edit"></i> Edit Position
        </button>
    </div>
    @endif
</div>

<!-- Image Cropper -->
<div id="cropperContainer" class="mb-3" style="display: none;">
    <hr>
    <h5><i class="fas fa-crop"></i> Adjust Image Position for Gallery Preview</h5>
    
    <div class="row mt-4">
        <!-- Cropper area -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-body p-0" style="position: relative; overflow: hidden; background: #f0f0f0; border-radius: 4px; max-height: 500px;">
                    <img id="cropperImage" src="" style="width: 100%; height: auto; display: block;">
                </div>
                <div class="card-footer">
                    <small class="text-muted">
                        <i class="fas fa-info-circle"></i> Drag to move the image around. Adjust which part you want to see in the gallery.
                    </small>
                </div>
            </div>
        </div>
        
        <!-- Preview area -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <strong>Preview (Gallery Card)</strong> - <small>Ratio 4:3</small>
                </div>
                <div class="card-body p-0" style="position: relative; aspect-ratio: 4/3; background: #f0f0f0; overflow: hidden;">
                    <div id="previewWrapper" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden;">
                        <img id="previewImage" src="" style="position: absolute; width: 100%; height: auto;">
                    </div>
                </div>
            </div>
            
            <div class="mt-3">
                <label class="form-label"><strong>Position Controls:</strong></label>
                <div class="btn-group d-grid gap-2" style="display: grid; grid-template-columns: repeat(2, 1fr);">
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="posUp"><i class="fas fa-arrow-up"></i> UP</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="posDown"><i class="fas fa-arrow-down"></i> DOWN</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="posLeft"><i class="fas fa-arrow-left"></i> LEFT</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="posRight"><i class="fas fa-arrow-right"></i> RIGHT</button>
                </div>
            </div>
            
            <button type="button" class="btn btn-sm btn-secondary w-100 mt-2" id="resetCrop">
                <i class="fas fa-redo"></i> Reset Position
            </button>
        </div>
    </div>
    
    <!-- Hidden inputs for crop data -->
    <input type="hidden" name="crop_x" id="crop_x" value="{{ old('crop_x', $gallery->crop_x ?? 0) }}">
    <input type="hidden" name="crop_y" id="crop_y" value="{{ old('crop_y', $gallery->crop_y ?? 0) }}">
    <input type="hidden" name="crop_width" id="crop_width" value="{{ old('crop_width', $gallery->crop_width ?? '') }}">
    <input type="hidden" name="crop_height" id="crop_height" value="{{ old('crop_height', $gallery->crop_height ?? '') }}">
</div>

<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" name="is_published" id="is_published" 
        {{ old('is_published', $gallery->is_published ?? false) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_published">
        <i class="fas fa-check-circle"></i> Publish to public gallery
    </label>
</div>

@push('styles')
<style>
    #previewWrapper {
        cursor: grab;
    }
    
    #previewWrapper.dragging {
        cursor: grabbing;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Gallery form script loaded');
        
        let isDragging = false;
        let startX = 0;
        let startY = 0;
        let offsetX = 0;
        let offsetY = 0;
        let imageWidth = 0;
        let imageHeight = 0;
        
        const imageInput = document.getElementById('image');
        const cropperContainer = document.getElementById('cropperContainer');
        const cropperImage = document.getElementById('cropperImage');
        const previewImage = document.getElementById('previewImage');
        const previewWrapper = document.getElementById('previewWrapper');
        const resetCropBtn = document.getElementById('resetCrop');
        const editCurrentImageBtn = document.getElementById('editCurrentImage');
        const posUp = document.getElementById('posUp');
        const posDown = document.getElementById('posDown');
        const posLeft = document.getElementById('posLeft');
        const posRight = document.getElementById('posRight');
        
        const STEP = 10;

        // Handle edit existing image
        if (editCurrentImageBtn) {
            editCurrentImageBtn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Edit position clicked');
                const currentImageSrc = cropperImage.parentElement.parentElement.parentElement.querySelector('img').src;
                if (currentImageSrc) {
                    cropperImage.src = currentImageSrc;
                    previewImage.src = currentImageSrc;
                    
                    // Load existing crop data
                    const cropX = parseInt(document.getElementById('crop_x').value) || 0;
                    const cropY = parseInt(document.getElementById('crop_y').value) || 0;
                    offsetX = -cropX;
                    offsetY = -cropY;
                    
                    cropperContainer.style.display = 'block';
                    updatePreview();
                    
                    // Scroll to cropper
                    cropperContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        }

        // Handle image file selection
        imageInput.addEventListener('change', function(e) {
            console.log('Image selected');
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    console.log('Image loaded');
                    const imgSrc = event.target.result;
                    cropperImage.src = imgSrc;
                    previewImage.src = imgSrc;
                    
                    // Reset position
                    offsetX = 0;
                    offsetY = 0;
                    
                    // Show cropper container
                    cropperContainer.style.display = 'block';
                    console.log('Cropper container shown');
                    
                    // Load image dimensions
                    const img = new Image();
                    img.onload = function() {
                        imageWidth = img.width;
                        imageHeight = img.height;
                        console.log('Image dimensions:', imageWidth, imageHeight);
                        updatePreview();
                    };
                    img.src = imgSrc;
                };
                reader.readAsDataURL(file);
            }
        });

        // Update preview position
        function updatePreview() {
            if (previewImage && previewImage.src) {
                previewImage.style.left = offsetX + 'px';
                previewImage.style.top = offsetY + 'px';
                saveCropData();
            }
        }

        // Save crop data to hidden inputs
        function saveCropData() {
            const cropX = Math.round(-offsetX);
            const cropY = Math.round(-offsetY);
            const cropWidth = previewWrapper.offsetWidth;
            const cropHeight = previewWrapper.offsetHeight;
            
            document.getElementById('crop_x').value = cropX;
            document.getElementById('crop_y').value = cropY;
            document.getElementById('crop_width').value = cropWidth;
            document.getElementById('crop_height').value = cropHeight;
            
            console.log('Crop data saved:', { cropX, cropY, cropWidth, cropHeight });
        }

        // Mouse events for dragging preview image
        if (previewWrapper) {
            previewWrapper.addEventListener('mousedown', function(e) {
                isDragging = true;
                startX = e.clientX - offsetX;
                startY = e.clientY - offsetY;
                previewWrapper.classList.add('dragging');
            });

            document.addEventListener('mousemove', function(e) {
                if (isDragging) {
                    offsetX = e.clientX - startX;
                    offsetY = e.clientY - startY;
                    updatePreview();
                }
            });

            document.addEventListener('mouseup', function() {
                isDragging = false;
                previewWrapper.classList.remove('dragging');
            });
        }

        // Position buttons
        if (posUp) {
            posUp.addEventListener('click', function(e) {
                e.preventDefault();
                offsetY += STEP;
                updatePreview();
            });
        }

        if (posDown) {
            posDown.addEventListener('click', function(e) {
                e.preventDefault();
                offsetY -= STEP;
                updatePreview();
            });
        }

        if (posLeft) {
            posLeft.addEventListener('click', function(e) {
                e.preventDefault();
                offsetX += STEP;
                updatePreview();
            });
        }

        if (posRight) {
            posRight.addEventListener('click', function(e) {
                e.preventDefault();
                offsetX -= STEP;
                updatePreview();
            });
        }

        // Reset position
        if (resetCropBtn) {
            resetCropBtn.addEventListener('click', function(e) {
                e.preventDefault();
                offsetX = 0;
                offsetY = 0;
                updatePreview();
                console.log('Position reset');
            });
        }

        // Initial load for edit mode with existing image
        window.addEventListener('load', function() {
            if (previewImage && previewImage.src && previewImage.src.trim() !== '') {
                const cropX = parseInt(document.getElementById('crop_x').value) || 0;
                const cropY = parseInt(document.getElementById('crop_y').value) || 0;
                offsetX = -cropX;
                offsetY = -cropY;
                updatePreview();
                console.log('Edit mode loaded with existing crop data');
            }
        });
        
        console.log('All event listeners attached');
    });
</script>
@endpush
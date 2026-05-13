<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if ($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>

    <div class="image-preview-wrapper {{ isset($value) && $value ? '' : 'd-none' }} mb-2">
        <small class="text-muted d-block mb-2">Preview gambar:</small>
        <img id="{{ $name }}-preview" src="{{ image_url($value) ?? '' }}" alt="{{ $label }}"
            class="img-fluid rounded" style="max-width: 180px; max-height: 180px; object-fit: cover;">
    </div>

    <input type="file" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
        name="{{ $name }}" accept="image/*" @if ($required ?? false) required @endif
        onchange="if (this.files && this.files[0]) { const previewWrapper = document.querySelector('#{{ $name }}-preview')?.closest('.image-preview-wrapper'); const reader = new FileReader(); reader.onload = function(e) { const preview = document.getElementById('{{ $name }}-preview'); if (preview) { preview.src = e.target.result; } if (previewWrapper) { previewWrapper.classList.remove('d-none'); } }; reader.readAsDataURL(this.files[0]); }">
    <small class="text-muted d-block mt-1">Format: JPG, PNG, GIF (Max: 2MB)</small>

    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

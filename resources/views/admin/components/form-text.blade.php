<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if ($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>
    <input type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
        name="{{ $name }}" value="{{ old($name, $value ?? '') }}" placeholder="{{ $placeholder ?? '' }}"
        @if ($step ?? false) step="{{ $step }}" @endif
        @if ($min ?? null) min="{{ $min }}" @endif
        @if ($max ?? null) max="{{ $max }}" @endif
        @if ($required ?? false) required @endif>
    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

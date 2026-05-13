<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if ($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>
    <select id="{{ $name }}" name="{{ $name }}" class="form-select @error($name) is-invalid @enderror"
        @if ($required ?? false) required @endif>
        <option value="">{{ $placeholder ?? 'Pilih ' . strtolower($label) }}</option>
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected(old($name, $selected ?? '') == $optionValue)>{{ $optionLabel }}</option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<div class="form-check mb-3">
    <input type="hidden" name="{{ $name }}" value="0">
    <input class="form-check-input @error($name) is-invalid @enderror" type="checkbox" id="{{ $name }}"
        name="{{ $name }}" value="1" @checked(old($name, $value ?? false))>
    <label class="form-check-label" for="{{ $name }}">
        {{ $label }}
    </label>
    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

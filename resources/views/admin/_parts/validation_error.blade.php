@if (isset($key))
    @error($key)
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
@endif

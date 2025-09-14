<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>
    <div class="relative mb-2">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
            <i class="{{ $icon }}"></i>
        </div>
        <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
            value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}"
            class="w-full border border-border rounded-lg px-3 py-2  ps-10 p-2.5 focus:ring focus:outline-none"
            {{ $required ? 'required' : '' }}>
    </div>
    @error($name)
        <p class="text-sm text-text-danger mt-1">{{ $message }}</p>
    @enderror
</div>

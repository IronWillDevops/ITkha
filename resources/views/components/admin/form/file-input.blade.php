<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>
    <input type="file" id="{{ $name }}" name="{{ $name }}"
        class="block w-full text-sm px-4 py-2 border border-input focus:ring focus:outline-none focus-visible:ring-ring rounded-lg {{ $class ?? '' }}">
    @error($name)
        <p class="text-sm text-error mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>
    <div class="relative mb-2">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
            <i class="{{ $icon }}"></i>
        </div>
        <input type="password" id="{{ $name }}" name="{{ $name }}"
             placeholder="{{ $placeholder }}" {{ $min ? "min=$min" : '' }}
            {{ $max ? "max=$max" : '' }}
            class="w-full text-sm caret-primary border border-input rounded-lg px-3 py-2 ps-10 p-2.5 focus:ring focus:outline-none focus-visible:ring-ring"
            {{ $required ? 'required' : '' }} >
        <button type="button" onclick="togglePasswordVisibility('{{ $name }}', this)"
            class="absolute right-2 top-1/2 transform -translate-y-1/2 text-primary hover:text-primary/90 focus:outline-none cursor-pointer"
            tabindex="-1">
            <i class="fas fa-eye"></i>
        </button>
    </div>
    @error($name)
        <p class="text-sm text-error mt-1">{{ $message }}</p>
    @enderror
</div>

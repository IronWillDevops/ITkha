<div >
    <div class="flex justify-between items-center">
        <label class="flex items-center cursor-pointer gap-2">
            <input name="{{ $name }}" type="checkbox" value="{{ $value ?? 1 }}"
                class="w-4 h-4 rounded border border-primary accent-primary focus:ring focus:ring-primary focus:outline-none focus-visible:ring-ring checked:text-primary-foreground"
                {{ old($name, $checked ?? false) ? 'checked' : '' }} {{ $required ? 'required' : '' }}>
            <span class="text-sm font-medium text-foreground">
                {!! $label !!}
                @if ($required)
                    <span class="text-danger">*</span>
                @endif
            </span>
        </label>

        @if ($slot->isNotEmpty())
            <div class="flex items-center">{{ $slot }}</div>
        @endif
    </div>

    @error($name)
        <p class="text-sm text-danger mt-1">{{ $message }}</p>
    @enderror
</div>
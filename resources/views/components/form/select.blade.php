<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>

    <div class="relative group">
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            class="w-full bg-background text-foreground border border-input rounded-2xl
                   px-4 py-2.5 shadow-sm transition-all duration-150 appearance-none
                   focus:outline-none focus:ring-2 focus:ring-ring focus:border-ring
                   group-hover:border-ring/40 cursor-pointer"
            {{ $required ? 'required' : '' }}
        >
            @foreach ($options as $option)
                @php
                    $optionValue = is_array($option) ? $option[$valueField] : $option->$valueField;
                    $optionLabel = is_array($option) ? $option[$labelField] : $option->$labelField;
                @endphp

                <option value="{{ $optionValue }}" @selected($selected == $optionValue)>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>

        {{-- Иконка --}}
        <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center">
            <svg class="h-5 w-5 text-muted-foreground transition-opacity group-focus-within:opacity-70"
                 viewBox="0 0 20 20" fill="currentColor">
                <path d="M5.25 7.5L10 12.25L14.75 7.5" stroke="currentColor" stroke-width="1.5" 
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>

    @error($name)
        <p class="text-sm text-error mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>

    <div class="relative">
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            class="w-full border border-input rounded-xl px-4 py-2 bg-background text-foreground
                   shadow-sm transition-all
                   focus:ring-2 focus:ring-ring focus:outline-none focus:border-ring
                   hover:border-ring/50 cursor-pointer appearance-none"
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

        {{-- Стрелка --}}
        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
            <svg class="h-4 w-4 text-muted-foreground" viewBox="0 0 20 20" fill="currentColor">
                <path
                    fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                    clip-rule="evenodd"
                />
            </svg>
        </div>
    </div>

    @error($name)
        <p class="text-sm text-error mt-1">{{ $message }}</p>
    @enderror
</div>

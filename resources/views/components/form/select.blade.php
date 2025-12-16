<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
        @if ($required)
            <span class="text-destructive">*</span>
        @endif
    </label>

    <select id="{{ $name }}" name="{{ $name }}"
        class="w-full border border-input rounded-lg px-3 py-2 focus:ring focus:outline-none focus-visible:ring-ring"
        {{ $required ? 'required' : '' }}>
        @foreach ($options as $option)
            @php
                $optionValue = is_array($option) ? $option[$valueField] : $option->$valueField;
                $optionLabel = is_array($option) ? $option[$labelField] : $option->$labelField;
            @endphp

            <option value="{{ $optionValue }}" class="bg-card text-card-foreground border border-input rounded-2xl"
                @selected($selected == $optionValue)>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-sm text-error mt-1">{{ $message }}</p>
    @enderror
</div>

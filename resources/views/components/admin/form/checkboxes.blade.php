<div>
    <label class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>

    <div class="flex flex-wrap gap-2">
        @foreach ($options as $option)
            <label class="inline-flex items-center space-x-2">
                <input type="checkbox" name="{{ $name }}[]" value="{{ $option->$valueField }}"
                    @checked(in_array($option->$valueField, old($name, $selected)))>
                <span>{{ $option->$labelField }}</span>
            </label>
        @endforeach
    </div>

    @error($name)
        <p class="text-sm text-text-danger mt-1">{{ $message }}</p>
    @enderror
</div>

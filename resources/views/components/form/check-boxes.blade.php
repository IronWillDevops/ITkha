<div>
    <label class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>

    <div class="flex flex-wrap gap-2">
        @foreach ($options as $option)
            <label class="inline-flex items-center space-x-2">
                <input type="checkbox" name="{{ $name }}[]" value="{{ $option->$valueField }}"
                    class="w-4 h-4 rounded border border-primary accent-primary focus:ring focus:ring-primary focus:outline-none focus-visible:ring-ring checked:text-primary-foreground"
                    @checked(in_array($option->$valueField, old($name, $selected)))>
                <span>{{ $option->$labelField }}</span>
            </label>
        @endforeach
    </div>

    @error($name)
        <p class="text-sm text-error mt-1">{{ $message }}</p>
    @enderror
</div>

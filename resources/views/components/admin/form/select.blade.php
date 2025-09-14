<div>
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>

    <select id="{{ $name }}" name="{{ $name }}" class="w-full border border-border rounded-lg px-3 py-2"
        {{ $required ? 'required' : '' }}>
        @foreach ($options as $option)
             <option value="{{ $option->$valueField }}" @selected($selected == $option->$valueField)>
                {{ $option->$labelField }} 
            </option> 
        @endforeach
    </select>

    @error($name)
        <p class="text-sm text-text-danger mt-1">{{ $message }}</p>
    @enderror
</div>

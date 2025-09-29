<div>
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>

    <select id="{{ $name }}" name="{{ $name }}" class="w-full border border-input rounded-lg px-3 py-2 focus:ring focus:outline-none focus-visible:ring-ring"
        {{ $required ? 'required' : '' }}>
        @foreach ($options as $option)
             <option value="{{ $option->$valueField }}" @selected($selected == $option->$valueField)>
                {{ $option->$labelField }} 
            </option> 
        @endforeach
    </select>

    @error($name)
        <p class="text-sm text-error mt-1">{{ $message }}</p>
    @enderror
</div>

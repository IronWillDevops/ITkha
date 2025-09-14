
<div>
    {{-- Скрытое поле нужно только для одиночного чекбокса (чтобы в запросе всегда было значение) --}}
    @if (!str_ends_with($name, '[]'))
        <input type="hidden" name="{{ $name }}" value="0" />
    @endif

    <label class="block text-sm font-medium mb-1">
        <input type="checkbox" name="{{ $name }}" value="{{ $value }}"
            @if (is_array(old(Str::beforeLast($name, '[]'))) && in_array($value, old(Str::beforeLast($name, '[]'), []))) checked
               @elseif($checked ?? false)
                   checked @endif>
        <span>{{ $label }}</span>
    </label>

    @error(Str::beforeLast($name, '[]'))
        <p class="text-sm text-text-danger mt-1">{{ $message }}</p>
    @enderror
</div>

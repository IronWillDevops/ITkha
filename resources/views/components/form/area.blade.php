<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>
    <div class="relative mb-2">
        <textarea type="text" name="{{ $name }}" id="{{ $name }}" minlength="{{ $min }}"
            maxlength="{{ $max }}" rows="8" data-counter="true"
            class="w-full max-w-full text-sm caret-primary border border-input rounded-lg px-3 py-2 p-2.5 focus:ring focus:outline-none focus-visible:ring-ring"
            placeholder="{{ $placeholder }}" oninput="updateCharacterCount(this)" {{ $required ? 'required' : '' }}
            {{ $readonly ? 'readonly' : '' }}>{{ old($name, $value) }}</textarea>
    </div>
    @error($name)
        <p class="text-sm text-text-danger mt-1">{{ $message }}</p>
    @enderror
    <div id="message-count" class="mt-4 text-xs text-text-secondary text-right">0 / {{ $max }}</div>
</div>
<script>
    function updateCharacterCount(textarea) {
        const maxLength = {{ $max }}; // Максимальна кількість символів, яку ви вказали у валідації
        const currentLength = textarea.value.length;
        const countElement = document.getElementById('message-count');
        countElement.textContent = `${currentLength} / ${maxLength}`;

        if (currentLength > maxLength) {
            countElement.classList.remove('text-muted-foreground');
            countElement.classList.add('text-error');
        } else {
            countElement.classList.remove('text-error');
            countElement.classList.add('text-muted-foreground');
        }
    }

    // Після повного завантаження сторінки
    document.addEventListener('DOMContentLoaded', function() {
        // Знаходимо всі textarea з лічильником
        document.querySelectorAll('textarea[data-counter="true"]').forEach(textarea => {
            updateCharacterCount(textarea);
        });
    });
</script>

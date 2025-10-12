<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>

    <textarea type="text" name="{{ $name }}" id="{{ $name }}" minlength="{{ $minCharactersLenght }}"  maxlength="{{ $maxCharactersLenght }}" rows="8" data-counter="true"
        class="w-full border border-border rounded-lg px-3 py-2 focus:ring focus:outline-none focus-visible:ring-ring  caret-primary text-sm "
        placeholder="{{ $placeholder }}" oninput="updateCharacterCount(this)"
        @if ($required) required @endif>{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-sm text-text-danger mt-1">{{ $message }}</p>
    @enderror
    <div id="message-count" class="mt-4 text-xs text-text-secondary text-right">0 / {{ $maxCharactersLenght }}</div>
</div>
<script>
    function updateCharacterCount(textarea) {
        const maxLength = {{ $maxCharactersLenght }}; // Максимальна кількість символів, яку ви вказали у валідації
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

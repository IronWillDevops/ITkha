<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>

    <textarea type="text" name="{{ $name }}" id="{{ $name }}" maxlength="1000" rows="8"
        class="w-full border border-border rounded-lg px-3 py-2 focus:ring focus:outline-none focus-visible:ring-ring  caret-primary  "
        placeholder="{{ $placeholder }}" oninput="updateCharacterCount(this)"
        @if ($required) required @endif>{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-sm text-text-danger mt-1">{{ $message }}</p>
    @enderror
    <div id="message-count" class="mt-4 text-xs text-text-secondary text-right">0 / 1000</div>
</div>
<script>
    function updateCharacterCount(textarea) {
        const maxLength = 1000; // Максимальна кількість символів, яку ви вказали у валідації
        const currentLength = textarea.value.length;
        const countElement = document.getElementById('message-count');
        countElement.textContent = `${currentLength} / ${maxLength}`;

        if (currentLength > maxLength) {
            countElement.classList.remove('text-muted');
            countElement.classList.add('text-danger');
        } else {
            countElement.classList.remove('text-danger');
            countElement.classList.add('text-muted');
        }
    }

    // Ініціалізація лічильника при завантаженні сторінки (для випадку, якщо є попередньо введені дані)
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('message');
        if (textarea) {
            updateCharacterCount(textarea);
        }
    });
</script>

<div class="mb-4">
    <label class="block mb-2 text-sm font-medium" for="{{ $name }}">{{ $text }}</label>
    <textarea type="text" name="{{ $name }}" id="{{ $name }}" maxlength="1000" rows="8"
        class="input input-hover text-sm  block w-full p-2.5" placeholder="{{ $placeholder }}"
        oninput="updateCharacterCount(this)" @if ($required) required @endif>{{ old($name, $value) }}</textarea>
    @error($name)
        <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
            {{ $message }}
        </div>
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

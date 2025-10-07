<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>
    <div class="relative mb-2">
        <textarea type="text" name="{{ $name }}" id="{{ $name }}" maxlength="1000" rows="8" data-counter="true"
            class="text-sm  border border-input caret-primary placeholder:text-muted-foreground text-foreground focus:ring focus:outline-none focus-visible:ring-ring block w-full rounded-lg px-3 py-2 p-2.5 "
            placeholder="{{ $placeholder }}" oninput="updateCharacterCount(this)"
            @if ($required) required @endif>{{ old($name, $value) }}</textarea>

        <div id="message-count" class="mt-4 text-xs text-muted-foreground text-right">0 / 1000</div>
    </div>
    @error($name)
        <p class="text-sm text-error mt-1">{{ $message }}</p>
    @enderror
</div>
<script>
    function updateCharacterCount(textarea) {
        const maxLength = 1000; // Максимальна кількість символів, яку ви вказали у валідації
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

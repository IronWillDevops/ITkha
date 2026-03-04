<div>
    <label class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>

    <div class="border border-input rounded-lg p-3">
        {{-- Поиск --}}
        <input type="text"
            placeholder="Search..."
            oninput="filterTags('{{ $name }}', this.value)"
            class="w-full text-sm caret-primary border border-input rounded-lg px-3 py-2 mb-3
                   focus:ring focus:outline-none focus-visible:ring-ring">

        {{-- Теги --}}
        <div id="{{ $name }}-tags" class="flex flex-wrap gap-2 max-h-48 overflow-y-auto">
            @foreach ($options as $option)
                <label class="cursor-pointer tag-item" data-label="{{ strtolower($option->$labelField) }}">
                    <input type="checkbox" name="{{ $name }}[]" value="{{ $option->$valueField }}"
                        class="sr-only peer"
                        @checked(in_array($option->$valueField, old($name, $selected)))>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm border border-input
                                 transition-colors cursor-pointer
                                 peer-checked:bg-primary peer-checked:text-primary-foreground peer-checked:border-primary
                                 hover:bg-accent hover:text-accent-foreground">
                        {{ $option->$labelField }}
                    </span>
                </label>
            @endforeach
        </div>

        {{-- Счётчик выбранных --}}
        <div id="{{ $name }}-counter" class="mt-2 text-xs text-muted-foreground"></div>
    </div>

    @error($name)
        <p class="text-sm text-danger mt-1">{{ $message }}</p>
    @enderror
</div>

<script>
    function filterTags(name, query) {
        const container = document.getElementById(name + '-tags');
        const items = container.querySelectorAll('.tag-item');
        const q = query.toLowerCase().trim();

        items.forEach(item => {
            const label = item.dataset.label;
            item.style.display = (!q || label.includes(q)) ? '' : 'none';
        });
    }

    // Счётчик выбранных
    document.querySelectorAll('.tag-item input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const name = this.name.replace('[]', '');
            const container = document.getElementById(name + '-tags');
            const counter = document.getElementById(name + '-counter');
            const checked = container.querySelectorAll('input:checked').length;
            counter.textContent = checked > 0 ? `Count: ${checked}` : '';
        });

        // Инициализация счётчика
        checkbox.dispatchEvent(new Event('change'));
    });
</script>
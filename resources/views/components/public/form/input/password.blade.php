<div class="mb-4">
    <label class="block mb-2 text-sm font-medium" for="{{ $name }}">{{ $text }}</label>
    <div class="relative mb-2">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
            <i class="{{ $icon }}"></i>
        </div>
        <input type="password" name="{{ $name }}" id="{{ $name }}" value="{{ old($name) }}"
            class="input input-hover text-sm block w-full ps-10 p-2.5" placeholder="{{ $placeholder }}" required
            @if ($showStrengthBar) oninput="updateSegmentedPasswordStrength(this.value, '{{ $name }}')" @endif >
        <button type="button" onclick="togglePasswordVisibility('{{ $name }}', this)"
            class="absolute right-2 top-1/2 transform -translate-y-1/2 hover:text-text-hover focus:outline-none">
            <i class="fas fa-eye"></i>
        </button>
    </div>

    @if ($showStrengthBar)
        <!-- Сегментований індикатор -->
        <div class="flex gap-1 h-2 mt-1" id="{{ $name }}-strength-bar">
            @for ($i = 1; $i <= 4; $i++)
                <div class="w-full bg-text-primary rounded" id="{{ $name }}-seg-{{ $i }}"></div>
            @endfor
        </div>
    @endif

    @error($name)
        <div class="mb-2 text-sm text-error rounded-lg" role="alert">
            {{ $message }}
        </div>
    @enderror
</div>

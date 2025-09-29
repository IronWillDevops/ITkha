<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        Captcha
    </label>
    <div class="relative mb-2">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
            <i class="fas fa-key"></i>
        </div>
        <input type="text" id="{{ $name }}" name="{{ $name }}"
            placeholder="{{ __('form.common.captcha') }}"
            class="w-full text-sm border border-input caret-primary placeholder:text-muted-foreground text-foreground rounded-lg px-3 py-2 ps-10 p-2.5 focus:ring focus:outline-none focus-visible:ring-ring"
            required>
    </div>
    <img src="{{ route('captcha.generate') }}" alt="Captcha"
        onclick="this.src='{{ route('captcha.generate') }}?'+Math.random()" style="cursor:pointer;">
    <small class="text-muted-foreground">{{ __('form.common.captcha_reload') }}</small>
    @error($name)
        <p class="text-sm text-error mt-1">{{ $message }}</p>
    @enderror
</div>

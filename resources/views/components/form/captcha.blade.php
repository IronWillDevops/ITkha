<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ __('public/common.fields.captcha') }}
    </label>
    <div class="relative mb-2">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
            <i class="fas fa-key"></i>
        </div>
        <input type="text" id="{{ $name }}" name="{{ $name }}"
            placeholder="{{ __('public/common.placeholder.captcha')  }}"
            class="w-full text-sm caret-primary border border-input rounded-lg px-3 py-2 ps-10 p-2.5 focus:ring focus:outline-none focus-visible:ring-ring"
            required>
    </div>
    <img src="{{ route('captcha.generate') }}" alt="Captcha"
        onclick="this.src='{{ route('captcha.generate') }}?'+Math.random()" style="cursor:pointer;">
    <small class="text-sm text-muted-foreground">{{ __('public/common.fields.captcha_reload') }}</small>
    @error($name)
        <p class="text-sm text-error mt-1">{{ $message }}</p>
    @enderror
</div>

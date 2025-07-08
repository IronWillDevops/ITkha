<div class="mb-4">
    <label class="block mb-2 text-sm font-medium" for="{{ $name }}">{{ $text }}</label>
    <div class="relative mb-2">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
            <i class="fas fa-key"></i>
        </div>
        <input type="text" name="{{ $name }}" id="{{ $name }}"
            class="input input-hover text-sm  block w-full ps-10 p-2.5 " placeholder="Enter Captcha" required />
    </div>
    <img src="{{ route('captcha.generate') }}" alt="{{ $text }}"
        onclick="this.src='{{ route('captcha.generate') }}?'+Math.random()" style="cursor:pointer;">
    <small>Click the image to reload the CAPTCHA</small>
    @error($name)
        <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
            {{ $message }}
        </div>
    @enderror
</div>

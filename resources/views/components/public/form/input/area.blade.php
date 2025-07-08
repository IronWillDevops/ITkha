<div class="mb-4">
    <label class="block mb-2 text-sm font-medium" for="{{ $name }}">{{ $text }}</label>
    <textarea type="text" name="{{ $name }}" id="{{ $name }}" maxlength="1000" rows="8"
        class="input input-hover text-sm  block w-full p-2.5" placeholder="{{ $placeholder }}" oninput="updateCharacterCount(this)"
        required>{{ old( $name) }}</textarea>
    @error( $name )
        <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
            {{ $message }}
        </div>
    @enderror
    <div id="message-count" class="mt-4 text-xs text-text-secondary text-right">0 / 1000</div>
</div>

 <div class="mb-4">
     <label class="block mb-2 text-sm font-medium" for="{{ $name }}">{{ $text }}</label>
     <div class="relative mb-2">
         <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
             <i class="{{ $icon }}"></i>
         </div>
         <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name) }}"
             class="input input-hover text-sm  block w-full ps-10 p-2.5 " placeholder="{{ $placeholder }}"
             @if ($required) required @endif />
     </div>
     @error($name )
         <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
             {{ $message }}
         </div>
     @enderror
 </div>

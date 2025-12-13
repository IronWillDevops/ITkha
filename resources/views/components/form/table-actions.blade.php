@if ($type == 'link')
    <a href="{{ $route }}"
        class="px-4 py-2 bg-background border-input hover:bg-accent hover:text-accent-foreground rounded-sm focus:ring focus:outline-none focus-visible:ring-ring md:p-1.5 shadow transition ">
        <i class="{{ $icon }}"></i>
        <span>{{ $label }}</span>
    </a>
@elseif ($type == 'form')
    <form action="{{ $route }}" method="POST">
        @csrf
        @method($method ?: 'POST') <!-- Если $method пуст, используем POST -->
        <button type="submit"
            class="px-4 py-2 bg-destructive text-destructive-foreground border-input hover:bg-destructive/80 hover:text-destructive-foreground/80 rounded-sm focus:ring focus:outline-none focus-visible:ring-ring md:p-1.5 shadow transition"
            onclick="return confirm('{{ __('admin/common.messages.confirm_delete') }}')">
            <i class="{{ $icon }}"></i>
            <span>{{ $label }}</span>
        </button>
    </form>
@endif

@php

    $baseClasses =
        'inline-flex items-center gap-2 px-4 py-2 border-input rounded-sm focus:ring focus:outline-none focus-visible:ring-ring md:p-1.5 shadow transition cursor-pointer';

    $variants = [
        'default' => 'bg-background hover:bg-accent hover:text-accent-foreground',
        'destructive' => 'bg-destructive text-destructive-foreground hover:bg-destructive/80',
        'primary' => 'bg-primary text-primary-foreground hover:bg-primary/90',
    ];

    $colorClasses = $variants[$variant] ?? $variants['default'];
    $fullClasses = "$baseClasses $colorClasses";
@endphp

@if ($type === 'link')
    <a href="{{ $route }}" class="{{ $fullClasses }}">
        @if ($icon)
            <i class="{{ $icon }}"></i>
        @endif
        <span>{{ $label }}</span>
    </a>
@elseif ($type === 'form')
    <form action="{{ $route }}" method="POST" class="inline-block">
        @csrf
        @if ($method)
            @method($method)
        @endif
        <button 
            type="submit" 
            class="{{ $fullClasses }}"
            @if ($confirm) 
                onclick="return confirm('{{ $confirmMessage }}')"
            @endif
        >
            @if ($icon)
                <i class="{{ $icon }}"></i>
            @endif
            <span>{{ $label }}</span>
        </button>
    </form>
@endif
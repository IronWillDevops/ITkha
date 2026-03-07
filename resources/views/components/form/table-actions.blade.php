@php
    $variants = [
        'default' => 'btn',
        'primary' => 'btn btn-primary',
        'danger'  => 'btn btn-danger',
    ];

    $classes = implode(' ', array_filter([
        $variants[$variant] ?? $variants['default'], 'btn-shimmer' ,
    ]));
@endphp

@if ($type === 'link')

    <a href="{{ $route }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon) <i class="{{ $icon }}"></i> @endif
        <span>{{ $label }}</span>
    </a>

@elseif ($type === 'form')

    <form action="{{ $route }}" method="POST" class="inline-block">
        @csrf
        @method($method)
        <button
            type="submit"
            {{ $attributes->merge(['class' => $classes]) }}
            @if ($confirm) onclick="return confirm('{{ $confirmMessage }}')" @endif
        >
            @if ($icon) <i class="{{ $icon }}"></i> @endif
            <span>{{ $label }}</span>
        </button>
    </form>

@endif
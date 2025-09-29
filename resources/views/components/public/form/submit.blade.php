  @props([
    'label' => __('Submit'),
    'class' => '', // дополнительный класс, по умолчанию пусто
])

<button
    type="submit"
    {{ $attributes->merge([
        'class' => "bg-primary text-text-primary-foreground hover:bg-primary/90 focus-visible:ring-ring rounded-sm font-medium text-sm px-5 py-2.5 text-center $class"
    ]) }}>
    {{ $label }}
</button>

  @props([
    'text' => __('Submit'),
    'class' => 'w-full', // дополнительный класс, по умолчанию пусто
])

<button
    type="submit"
    {{ $attributes->merge([
        'class' => "input-btn input-btn-hover font-medium text-sm px-5 py-2.5 text-center $class"
    ]) }}>
    {{ $text }}
</button>

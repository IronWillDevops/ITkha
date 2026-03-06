  @props([
      'label' => __('Submit'),
      'class' => '', // дополнительный класс, по умолчанию пусто
  ])

  <button type="submit"
      {{ $attributes->merge([
          'class' => "btn btn-primary btn-shimmer text-center justify-center $class",
      ]) }}>
      {{ $label }}
  </button>

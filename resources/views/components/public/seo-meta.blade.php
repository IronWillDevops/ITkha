{{-- ROBOTS --}}
<meta name="robots" content="index, follow">

<!-- OpenGraph -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:site_name" content="{{ config('app.name') }}">

{{-- Extra OG fields --}}
@if(!empty($extra))
    @foreach($extra as $key => $value)
        @if(is_array($value))
            @foreach($value as $v)
                <meta property="{{ $key }}" content="{{ $v }}">
            @endforeach
        @else
            <meta property="{{ $key }}" content="{{ $value }}">
        @endif
    @endforeach
@endif

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
<meta name="twitter:url" content="{{ $url }}">

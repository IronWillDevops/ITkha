@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="flex flex-col gap-6">
        <article class="w-full bg-card text-muted-foreground rounded-2xl border border-border">

            <!-- Контейнер для контента политики -->
            <div class="w-full p-8 bg-surface rounded-2xl">
                <div class="text-center mb-6 text-accent-foreground ">
                    <!-- Заголовок политики -->
                    <h2 class="text-2xl font-bold mb-2">{!! $translation->title !!}</h2>
                </div>

                <!-- Информация о версии и дате создания -->
                <div class="flex justify-between text-sm text-mute mb-4">
                    <span>{{ __('admin/common.fields.version') }}: {{ $policy->version }}</span>
                    <span>{{ __('admin/common.fields.created_at') }}: {{ $translation->created_at }}</span>
                </div>

                <x-public.ui.separator />
                <!-- Содержание политики -->
                <div id="post-content" class="policy-content mb-6 prose prose-neutral" >
                    {!! $translation->content !!}
                </div>

                <!-- Кнопка принятия политики (только для авторизованных пользователей) -->
                @auth
                    <x-public.ui.separator />
                    <form method="POST" action="{{ route('policy.accept') }}">
                        @csrf
                        <x-form.submit label="{{ __('admin/common.buttons.accept') }}" />
                    </form>
                @endauth
            </div>
    </article>
    </div>
@endsection

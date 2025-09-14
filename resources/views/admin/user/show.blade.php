@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/users.title') }} | {{ $user->login }}
@endsection

@section('admin.content')
    <div class="mx-auto p-4 bg-surface border border-border rounded-lg text-text-primary">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.user.edit', $user->id) }}"
                class="px-4 py-2 border border-border rounded-xl shadow transition">
                <i class="fas fa-edit"></i> {{ __('admin/users.actions.edit') }}
            </a>

            <form action="{{ route('admin.user.delete', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 border border-border rounded-xl shadow transition text-text-danger"
                    onclick="return confirm('{{ __('admin/common.messages.confirm_delete') }}')">
                    <i class="fas fa-trash-alt"></i> {{ __('admin/users.actions.delete') }}
                </button>
            </form>
        </div>

        {{-- Аватар --}}
        @if ($user->avatar)
            <img type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"
                class="relative inline-flex items-center justify-center w-24 h-24 object-cover rounded-full border border-border"
                src="{{ asset('storage/' . $user->avatar) }}" data-filename="image.png" alt="{{ $user->name }}">
        @else
            <div
                class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden rounded-full border border-border">
                <span class="font-bold">
                    {{ $user->getInitial() }}
                </span>
            </div>
        @endif

        {{-- Основные данные --}}
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm">
            <div>
                <span class="font-medium">{{ __('admin/users.fields.name') }}:</span>
                {{ $user->name }} {{ $user->surname }}
            </div>
            <div>
                <span class="font-medium">{{ __('admin/users.fields.login') }}:</span>
                {{ $user->login }}
            </div>
            <div>
                <span class="font-medium">{{ __('admin/users.fields.email') }}:</span>
                {{ $user->email }}
                @if ($user->email_verified_at)
                    <span class="ml-1 text-xs text-green-600">
                        ({{ __('admin/users.messages.verified') }})
                    </span>
                @else
                    <span class="ml-1 text-xs text-red-600">
                        ({{ __('admin/users.messages.not_verified') }})
                    </span>
                @endif
            </div>
            <div>
                <span class="font-medium">{{ __('admin/users.fields.status') }}:</span>
                <span class="px-2 py-1 rounded-lg text-xs">
                    {{ $user->status }}
                </span>
            </div>
            <div>
                <span class="font-medium">{{ __('admin/users.fields.created_at') }}:</span>
                {{ $user->created_at }}
            </div>
            <div>
                <span class="font-medium">{{ __('admin/users.fields.updated_at') }}:</span>
                {{ $user->updated_at }}
            </div>
        </div>

        {{-- Профиль --}}
        @if ($user->profile)
            <div class="border-t border-border pt-4">
                <h2 class="text-lg font-semibold mb-2">
                    {{ __('admin/profile.title') }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="font-medium">{{ __('admin/profile.fields.address') }}:</span>
                        {{ $user->profile->address ?? '-' }}
                    </div>
                    <div>
                        <span class="font-medium">{{ __('admin/profile.fields.job_title') }}:</span>
                        {{ $user->profile->job_title ?? '-' }}
                    </div>
                    <div class="md:col-span-2">
                        <span class="font-medium">{{ __('admin/profile.fields.about_myself') }}:</span>
                        <p class="mt-1 text-text-secondary">
                            {{ $user->profile->about_myself ?? '-' }}
                        </p>
                    </div>
                    <div>
                        <span class="font-medium">GitHub:</span>
                        @if ($user->profile->github)
                            <a href="{{ $user->profile->github }}" target="_blank" class="text-link hover:underline">
                                {{ $user->profile->github }}
                            </a>
                        @else
                            -
                        @endif
                    </div>
                    <div>
                        <span class="font-medium">LinkedIn:</span>
                        @if ($user->profile->linkedin)
                            <a href="{{ $user->profile->linkedin }}" target="_blank" class="text-link hover:underline">
                                {{ $user->profile->linkedin }}
                            </a>
                        @else
                            -
                        @endif
                    </div>
                    <div>
                        <span class="font-medium">Website:</span>
                        @if ($user->profile->website)
                            <a href="{{ $user->profile->website }}" target="_blank" class="text-link hover:underline">
                                {{ $user->profile->website }}
                            </a>
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="mx-auto p-4 mt-4 bg-surface border border-border rounded-lg text-text-primary">
        {{-- Таблица постов --}}
        <div class="overflow-x-auto shadow ">
            <table class="min-w-full divide-y ">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/posts.fields.id') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/posts.fields.title') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/posts.fields.categories') }}
                        </th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/posts.fields.tags') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/posts.fields.status') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/posts.fields.created_at') }}
                        </th>
                        <th class="px-4 py-2 text-center text-sm font-semibold">{{ __('admin/common.actions.title') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y ">
                    @forelse($posts as $post)
                        <tr>
                            <td class="px-4 py-2 text-sm ">{{ $post->id }}</td>
                            <td class="px-4 py-2 text-sm  font-medium link hover:link-hover hover:underline">
                                <a href ="{{ route('admin.post.show', $post->id) }}">{{ $post->title }}</a>
                            </td>
                            <td class="px-4 py-2 text-sm font-medium link hover:link-hover hover:underline">
                                <a href="{{ route('admin.post.show', $post->id) }}">
                                    {{ $post->category->title }}
                                </a>
                            </td>
                            <td class="px-4 py-2 text-sm ">
                                @forelse($post->tags as $tag)
                                    <span class="inline-block  px-2 py-0.5 rounded-lg text-xs">
                                        {{ $tag->title }}
                                    </span>
                                @empty
                                    <span class=" text-xs">-</span>
                                @endforelse
                            </td>
                            <td class="px-4 py-2 text-sm">
                                <span class="px-2 py-1 rounded-lg text-xs">
                                    {{ $post->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-sm">
                                {{ $post->created_at }}
                            </td>
                            <td class="px-4 py-2 text-sm text-right space-x-2 flex justify-end">
                                {{-- Кнопка редагування --}}
                                <a href="{{ route('admin.post.edit', $post->id) }}"
                                    class="inline-flex items-center p-2 rounded-lg transition" title="#">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Кнопка видалення --}}
                                <form action="{{ route('admin.post.delete', $post->id) }}" method="POST"
                                    onsubmit="return confirm('{{ __('admin/common.messages.confirm_delete') }}')"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center p-2 text-text-danger rounded-lg transition cursor-pointer"
                                        title="#">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-sm">
                                {{ __('admin/common.messages.no_records') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Пагинация --}}
        <div class="mt-6">
            {{ $posts->links('vendor.pagination.pagination') }}
        </div>
    </div>
@endsection

@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/user.title') }} | {{ $user->login }}
@endsection

@section('admin.content')
    <div class="flex items-center gap-4 mb-4">
        <x-admin.form.action-button type='link' route="{{ route('admin.user.edit', $user) }}" icon="fas fa-edit"
            label="{{ __('admin/common.buttons.edit') }}" />
        <x-admin.form.action-button type='form' method="DELETE" route="{{ route('admin.user.delete', $user) }}"
            icon="fas fa-trash-alt" label="{{ __('admin/common.buttons.delete') }}" />
    </div>

    {{-- Personal --}}
    <div class="mb-6 ">
        <h2 class="text-lg font-semibold mb-2">
            {{ __('admin/user.sections.personal') }}
        </h2>
        @if ($user->avatar)
            <img type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"
                class="relative inline-flex items-center justify-center w-24 h-24 object-cover rounded-full border border-border"
                src="{{ asset('storage/' . $user->avatar) }}" data-filename="image.png" alt="{{ $user->first_name }}">
        @else
            <div
                class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden rounded-full border border-border  text-5xl">
                <span class="font-bold">
                    {{ $user->getInitial() }}
                </span>
            </div>
        @endif

        {{-- Основные данные --}}
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm">
            <div>
                <span class="font-medium">{{ __('admin/common.fields.first_name') }}:</span>
                {{ $user->first_name }} {{ $user->last_name }}
            </div>
            <div>
                <span class="font-medium">{{ __('admin/user.fields.login') }}:</span>
                {{ $user->login }}
            </div>
            <div>
                <span class="font-medium">{{ __('admin/common.fields.email') }}:</span>
                {{ $user->email }}
                @if ($user->email_verified_at)
                    <span class="ml-1 text-xs text-success">
                        ({{ __('admin/user.messages.verified') }})
                    </span>
                @else
                    <span class="ml-1 text-xs text-error">
                        ({{ __('admin/user.messages.not_verified') }})
                    </span>
                @endif
            </div>
            <div>
                <span class="font-medium">{{ __('admin/common.fields.status') }}:</span>
                <span class="px-2 py-1 rounded-lg text-xs">
                    {{ $user->status }}
                </span>
            </div>
            <div>
                <span class="font-medium">{{ __('admin/common.fields.created_at') }}:</span>
                {{ $user->created_at }}
            </div>
            <div>
                <span class="font-medium">{{ __('admin/common.fields.updated_at') }}:</span>
                {{ $user->updated_at }}
            </div>
        </div>
    </div>

    {{-- Professional --}}
    @if ($user->profile)
        <div class="border-t border-border pt-4  mb-6 ">
            <h2 class="text-lg font-semibold mb-2">
                {{ __('admin/user.sections.job') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="font-medium">{{ __('admin/user.fields.address') }}:</span>
                    {{ $user->profile?->address ?? '-' }}
                </div>
                <div>
                    <span class="font-medium">{{ __('admin/user.fields.job_title') }}:</span>
                    {{ $user->profile?->job_title ?? '-' }}
                </div>
                <div class="md:col-span-2">
                    <span class="font-medium">{{ __('admin/user.fields.about_myself') }}:</span>
                    <p class="mt-1 text-text-secondary">
                        {{ $user->profile?->about_myself ?? '-' }}
                    </p>
                </div>

            </div>
        </div>
    @endif

    {{-- social --}}
    <div class="border-t border-border pt-4  mb-6 ">
        <h2 class="text-lg font-semibold mb-2">
            {{ __('admin/user.sections.social') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="font-medium">Website:</span>
                @if ($user->profile?->website)
                    <a href="{{ $user->profile?->website }}" target="_blank"
                        class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                        {{ $user->profile?->website }}
                    </a>
                @else
                    -
                @endif
            </div>
            <div>
                <span class="font-medium">GitHub:</span>
                @if ($user->profile?->github)
                    <a href="{{ $user->profile?->github }}" target="_blank"
                        class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                        {{ $user->profile?->github }}
                    </a>
                @else
                    -
                @endif
            </div>
            <div>
                <span class="font-medium">LinkedIn:</span>
                @if ($user->profile?->linkedin)
                    <a href="{{ $user->profile?->linkedin }}" target="_blank"
                        class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                        {{ $user->profile?->linkedin }}
                    </a>
                @else
                    -
                @endif
            </div>
        </div>
    </div>

    <div class="border-t border-border pt-4">
        <h2 class="text-lg font-semibold mb-2">
            {{ __('admin/common.fields.post') }}
        </h2>

        <x-admin.form.table :columns="$columns" :items="$posts" modelRoute="post" :sortField="$sortField" :sortDirection="$sortDirection"
            searchEnabled="true" />
    </div>
@endsection

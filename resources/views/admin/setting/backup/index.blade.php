@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/settings/backup.title') }}
@endsection

@section('admin.content')

    <div class="flex items-center justify-between mb-6">
        <x-form.table-actions type='form' route="{{ route('admin.setting.backup.create') }}" icon="fa-solid fa-plus"
            label="{{ __('admin/common.buttons.create') }}" variant="primary" />
    </div>



    {{-- Backups List --}}
    <div class="bg-card text-card-foreground rounded-lg shadow-sm p-6">
                @if (count($backups) > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b">
                        <tr class="text-left">
                            <th class="py-3 px-4 text-sm font-medium text-muted-foreground">
                                {{ __('admin/common.fields.file.name') }}
                            </th>
                            <th class="py-3 px-4 text-sm font-medium text-muted-foreground">
                                {{ __('admin/common.fields.file.size') }}
                            </th>
                            <th class="py-3 px-4 text-sm font-medium text-muted-foreground">
                                {{ __('admin/common.fields.created_at') }}
                            </th>
                            <th class="py-3 px-4 text-sm font-medium text-muted-foreground text-right">
                                {{ __('admin/common.fields.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach ($backups as $backup)
                            <tr class="hover:bg-muted/50 transition-colors">
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-file-archive text-muted-foreground mr-3"></i>
                                        <span class="text-sm font-medium">{{ $backup['filename'] }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="text-sm text-muted-foreground">{{ formatBytes($backup['size']) }}</span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="text-sm text-muted-foreground">
                                        {{ date('d.m.Y H:i', $backup['created_at']) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-end space-x-2">
                                        {{-- Download --}}
                                        <a href="{{ route('admin.setting.backup.download', ['filename' => $backup['filename']]) }}"
                                            class="inline-flex items-center text-sm cursor-pointer rounded-md p-2 bg-primary text-primary-foreground hover:bg-primary/90"
                                            title="{{ __('admin/common.buttons.save') }}">
                                            <i class="fas fa-download"></i>
                                        </a>

                                        {{-- Restore --}}
                                        <form action="{{ route('admin.setting.backup.restore') }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            <input type="hidden" name="filename" value="{{ $backup['filename'] }}">

                                            <button type="submit" class="inline-flex items-center text-sm cursor-pointer rounded-md p-2 bg-background text-background-foreground  hover:bg-accent hover:text-accent-foreground"
                                                title="{{ __('admin/common.buttons.restore') }}">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </form>


                                        {{-- Delete --}}
                                        <form action="{{ route('admin.setting.backup.delete') }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="filename" value="{{ $backup['filename'] }}">

                                            <button type="submit"
                                                class="inline-flex items-center text-sm cursor-pointer rounded-md p-2 bg-destructive text-destructive-foreground hover:bg-destructive/90 "
                                                title="{{ __('admin/common.buttons.delete') }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-inbox text-muted-foreground text-5xl mb-4"></i>
                <p class="text-muted-foreground text-lg">{{ __('admin/settings/backup.list.empty') }}</p>
                <p class="text-muted-foreground text-sm mt-2">{{ __('admin/settings/backup.list.empty_description') }}</p>
            </div>
        @endif
    </div>

    {{-- Hidden Forms --}}
    <form id="restoreForm" action="{{ route('admin.setting.backup.restore') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="filename" id="restoreFilename">
    </form>

    <form id="deleteForm" action="{{ route('admin.setting.backup.delete') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="filename" id="deleteFilename">
    </form>

@endsection


@php
    function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
@endphp

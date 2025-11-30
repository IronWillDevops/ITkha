@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/log.title') }}
@endsection
@section('admin.content')
    <div class="overflow-x-auto">
        <table class="min-w-full ">
            <thead class="">
                <tr class="">
                    <th class="px-3 py-2 whitespace-nowrap">{{ __('admin/common.fields.id') }}</th>
                    <th class="px-3 py-2 whitespace-nowrap">{{ __('admin/common.fields.description') }}</th>
                    <th class="px-3 py-2 whitespace-nowrap">{{ __('admin/settings/log.fields.event') }}</th>
                    <th class="px-3 py-2 whitespace-nowrap">{{ __('admin/common.fields.user') }}</th>
                    <th class="px-3 py-2 whitespace-nowrap">{{ __('admin/common.fields.ip_address') }}</th>
                    <th class="px-3 py-2 whitespace-nowrap">{{ __('admin/common.fields.created_at') }}</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($logs as $log)
                    <tr class="">
                        <td class="px-3 py-2 whitespace-nowrap">{{ $log->id }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $log->description }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $log->event }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $log->user_email }}</td>
                        <td class="px-3 py-2 whitespace-nowrap" title="{{ $log->user_agent }}">{{ $log->ip_address }}
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex justify-center mt-6">
            {{ $logs->links('vendor.pagination.pagination') }}
        </div>
    </div>
@endsection

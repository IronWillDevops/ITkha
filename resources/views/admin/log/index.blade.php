@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/logs.title') }}
@endsection
@section('admin.content')
    <div class="bg-surface p-4 text-text-primary  border border-border rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full ">
                <thead class="">
                    <tr class="">
                        <th class="px-3 py-2 whitespace-nowrap">{{ __('admin/logs.fields.id') }}</th>
                        <th class="px-3 py-2 whitespace-nowrap">{{ __('admin/logs.fields.description') }}</th>
                        <th class="px-3 py-2 whitespace-nowrap">{{ __('admin/logs.fields.event') }}</th>
                        <th class="px-3 py-2 whitespace-nowrap">{{ __('admin/logs.fields.user') }}</th>
                        <th class="px-3 py-2 whitespace-nowrap">{{ __('admin/logs.fields.ip_address') }}</th>
                        <th class="px-3 py-2 whitespace-nowrap">{{ __('admin/logs.fields.created_at') }}</th>
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
    </div>
@endsection

@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/contact.title') }}
@endsection

@section('admin.content')


    {{-- Таблица писем --}}
    <div class="overflow-x-auto shadow">
        <table class="min-w-full divide-y">
            <thead>
                <tr class="font-semibold">
                    <th class="px-4 py-2 text-left text-sm">{{ __('admin/common.fields.id') }}</th>
                    <th class="px-4 py-2 text-left text-sm">{{ __('admin/common.fields.name') }}</th>
                    <th class="px-4 py-2 text-left text-sm">{{ __('admin/contact.fields.subject') }}</th>
                    <th class="px-4 py-2 text-left text-sm">{{ __('admin/common.fields.email') }}</th>
                    <th class="px-4 py-2 text-left text-sm">{{ __('admin/common.fields.created_at') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($contacts as $contact)
                    <tr class="text-sm {{ $contact->is_read ? '' : ' font-bold' }}">
                        <td class="px-4 py-2">{{ $contact->id }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.contact.show',$contact->id) }}" class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                {{ $contact->name }}
                            </a>
                        </td>
                        <td class="px-4 py-2">{{ $contact->subject }}</td>
                        <td class="px-4 py-2">{{ $contact->email }}</td>
                       
                        <td class="px-4 py-2">{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center">
                            {{ __('admin/common.messages.no_records') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Пагинация --}}
    <div class="mt-6">
        {{ $contacts->links('vendor.pagination.pagination') }}
    </div>
@endsection

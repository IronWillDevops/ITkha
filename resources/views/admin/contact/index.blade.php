@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/contacts.title') }}
@endsection

@section('admin.content')


    {{-- Таблица писем --}}
    <div class="overflow-x-auto shadow">
        <table class="min-w-full divide-y">
            <thead>
                <tr class="font-semibold">
                    <th class="px-4 py-2 text-left text-sm">{{ __('admin/contacts.fields.id') }}</th>
                    <th class="px-4 py-2 text-left text-sm">{{ __('admin/contacts.fields.name') }}</th>
                    <th class="px-4 py-2 text-left text-sm">{{ __('admin/contacts.fields.subject') }}</th>
                    <th class="px-4 py-2 text-left text-sm">{{ __('admin/contacts.fields.email') }}</th>
                    <th class="px-4 py-2 text-left text-sm">{{ __('admin/contacts.fields.created_at') }}</th>
                    <th class="px-4 py-2 text-center text-sm">{{ __('admin/common.actions.title') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($contacts as $contact)
                    <tr class="text-sm {{ $contact->is_read ? '' : ' font-bold' }}">
                        <td class="px-4 py-2">{{ $contact->id }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.setting.contact.show',$contact->id) }}" class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                {{ $contact->name }}
                            </a>
                        </td>
                        <td class="px-4 py-2">{{ $contact->subject }}</td>
                        <td class="px-4 py-2">{{ $contact->email }}</td>
                       
                        <td class="px-4 py-2">{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2 text-right space-x-2 flex justify-end">
                            {{-- Кнопка редактирования --}}
                            <a href="#" class="inline-flex items-center p-2 rounded-lg transition focus:ring focus:outline-none focus-visible:ring-ring" title="{{ __('admin/contacts.actions.edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>

                            {{-- Кнопка удаления --}}
                            <form action="#" method="POST" onsubmit="return confirm('{{ __('admin/common.messages.confirm_delete') }}')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center p-2 bg-destructive text-destructive-foreground rounded-lg transition focus:ring focus:outline-none focus-visible:ring-ring cursor-pointer" title="{{ __('admin/contacts.actions.delete') }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
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

@extends('admin.layouts.app')

@section('admin.content.header')
    Message
@endsection

@section('admin.content')
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="btn-group">
                <a href="{{ route('admin.contact.index', ['filter' => null]) }}"
                    class="btn btn-outline-secondary {{ is_null(request('filter')) ? 'active' : '' }}">
                    All
                </a>
                <a href="{{ route('admin.contact.index', ['filter' => 'unread']) }}"
                    class="btn btn-outline-secondary {{ request('filter') === 'unread' ? 'active' : '' }}">
                    Unread
                </a>
                <a href="{{ route('admin.contact.index', ['filter' => 'read']) }}"
                    class="btn btn-outline-secondary {{ request('filter') === 'read' ? 'active' : '' }}">
                    Read
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Message</h3>
                </div>
                <!-- ./card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>
                                        <a
                                            href="mailto:{{ $contact->email }}?subject={{ $contact->subject }}">{{ $contact->email }}</a>
                                    </td>
                                    <td>{{ $contact->subject }}</td>
                                    <td>{{ $contact->created_at }}</td>
                                    <td>
                                        <div class='btn-group'>
                                            <form action="{{ route('admin.contact.update', $contact->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-default" title="Mark as Read">
                                                    <i
                                                        class="fas {{ $contact->is_read ? 'fa-envelope-open' : 'fa-envelope' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.contact.delete', $contact->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-default">
                                                    <a href="#" onclick="return confirm('Sure delete?')"
                                                        class="text-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </button>

                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="expandable-body d-none">
                                    <td colspan="6">
                                        <p style="display: none;">{{ $contact->message }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $contacts->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

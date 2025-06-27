@extends('admin.layouts.app')

@section('admin.content.header')
    Log
@endsection

@section('admin.content')
    <div class="card card-default color-palette-box">

        
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">History</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event</th>
                                <th>Description</th>
                                <th>User</th>
                                <th>IP address</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr><div>
                                    <td>{{ $log->id }}</td>
                                    <td>{{ $log->event }}</td>
                                    <td>{{ $log->description }}</td>
                                    <td>{{ $log->user_email }}</td>
                                    <td title="{{ $log->user_agent }}">{{ $log->ip_address }}</td>
                                    <td>{{ $log->created_at }}</td></div>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="card-footer clearfix">
                    {{ $logs->links('pagination::bootstrap-5') }}
                </div>
                <!-- /.card-body -->
            </div>

        </div>
        <!-- /.card-body -->
    </div>
@endsection

@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/info.title') }}
@endsection
@section('admin.content')
    <div class=" mx-auto p-4 bg-surface border border-border rounded-lg text-text-primary">
        <div class="p-6 rounded shadow">

            {{-- PHP --}}
            <h2 class="text-xl font-bold mt-6 mb-2">PHP</h2>
            <x-admin.form.table :data="$info['php']" />

            {{-- Laravel --}}
            <h2 class="text-xl font-bold mt-6 mb-2">Laravel</h2>
            <x-admin.form.table :data="$info['laravel']" />

            {{-- System --}}
            <h2 class="text-xl font-bold mt-6 mb-2">System</h2>
            <x-admin.form.table :data="$info['system']" />

            {{-- Services --}}
            <h2 class="text-xl font-bold mt-6 mb-2">Services</h2>
            <x-admin.form.table :data="$info['services']" />

            {{-- Час --}}
            <h2 class="text-xl font-bold mt-6 mb-2">Time</h2>
            <x-admin.form.table :data="$info['time']" />

            {{-- Composer --}}
            <h2 class="text-xl font-bold mt-6 mb-2">Composer packeges</h2>
            <div class="max-h-64 overflow-y-auto border rounded p-2 text-sm">
                <ul>
                    @foreach ($info['composer'] as $package => $version)
                        <li class="flex justify-between border-b py-1">
                            <span>{{ $package }}</span>
                            <span class="">{{ $version }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    </div>
@endsection

@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/settings/info.title') }}
@endsection
@section('admin.content')
 

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
        <div class="max-h-96 overflow-y-auto border rounded p-2 text-sm  focus:ring focus:outline-none focus-visible:ring-ring">
            <ul>
                @foreach ($info['composer'] as $package => $version)
                    <li class="flex justify-between border-b py-1">
                        <span>{{ $package }}</span>
                        <span class="">{{ $version }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
@endsection

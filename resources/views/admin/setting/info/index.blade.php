@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/settings/info.title') }}
@endsection
@section('admin.content')
 <div class="p-6 space-y-10">

    <h1 class="text-3xl font-bold mb-6">Server Information</h1>

    <!-- PHP Info -->
    <div>
        <h2 class="text-xl font-semibold mb-3">PHP Information</h2>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full ">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Parameter</th>
                        <th class="px-4 py-2 text-left">Value</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr><td class="px-4 py-2">Version</td><td class="px-4 py-2">{{ $info['php']['version'] }}</td></tr>
                    <tr><td class="px-4 py-2">Memory Limit</td><td class="px-4 py-2">{{ $info['php']['memory_limit'] }}</td></tr>
                    <tr><td class="px-4 py-2">Max Execution Time</td><td class="px-4 py-2">{{ $info['php']['max_execution_time'] }}</td></tr>
                    <tr><td class="px-4 py-2">Upload Max Filesize</td><td class="px-4 py-2">{{ $info['php']['upload_max_filesize'] }}</td></tr>
                    <tr><td class="px-4 py-2">Loaded Extensions</td><td class="px-4 py-2">{{ implode(', ', $info['php']['extensions']) }}</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Laravel Info -->
    <div>
        <h2 class="text-xl font-semibold mb-3">Laravel Information</h2>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full ">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Parameter</th>
                        <th class="px-4 py-2 text-left">Value</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($info['laravel'] as $key => $value)
                        <tr>
                            <td class="px-4 py-2 capitalize">{{ str_replace('_', ' ', $key) }}</td>
                            <td class="px-4 py-2">{{ $value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- System Info -->
    <div>
        <h2 class="text-xl font-semibold mb-3">System Information</h2>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full ">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Parameter</th>
                        <th class="px-4 py-2 text-left">Value</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr><td class="px-4 py-2">Operating System</td><td class="px-4 py-2">{{ $info['system']['os'] }}</td></tr>
                    <tr><td class="px-4 py-2">Uptime</td><td class="px-4 py-2">{{ $info['system']['uptime'] }}</td></tr>
                    <tr><td class="px-4 py-2">CPU Cores</td><td class="px-4 py-2">{{ $info['system']['cpu_cores'] }}</td></tr>
                    <tr>
                        <td class="px-4 py-2">Load Average</td>
                        <td class="px-4 py-2">
                            {{ isset($info['system']['load_average']) ? implode(', ', $info['system']['load_average']) : 'N/A' }}
                        </td>
                    </tr>
                    <tr><td class="px-4 py-2">Memory Usage</td><td class="px-4 py-2">{{ $info['system']['memory_usage'] }}</td></tr>
                    <tr><td class="px-4 py-2">Memory Peak</td><td class="px-4 py-2">{{ $info['system']['memory_peak'] }}</td></tr>
                    <tr><td class="px-4 py-2">Disk Free</td><td class="px-4 py-2">{{ $info['system']['disk_free'] }}</td></tr>
                    <tr><td class="px-4 py-2">Disk Total</td><td class="px-4 py-2">{{ $info['system']['disk_total'] }}</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Services -->
    <div>
        <h2 class="text-xl font-semibold mb-3">Services</h2>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full ">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Service</th>
                        <th class="px-4 py-2 text-left">Status / Version</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr><td class="px-4 py-2">Database</td><td class="px-4 py-2">{{ $info['services']['database'] }}</td></tr>
                    <tr><td class="px-4 py-2">Redis</td><td class="px-4 py-2">{{ $info['services']['redis'] }}</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Time Info -->
    <div>
        <h2 class="text-xl font-semibold mb-3">Time & Server</h2>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full ">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Parameter</th>
                        <th class="px-4 py-2 text-left">Value</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr><td class="px-4 py-2">PHP Now</td><td class="px-4 py-2">{{ $info['time']['php_now'] }}</td></tr>
                    <tr><td class="px-4 py-2">Timezone</td><td class="px-4 py-2">{{ $info['time']['system_timezone'] }}</td></tr>
                    <tr><td class="px-4 py-2">Server Address</td><td class="px-4 py-2">{{ $info['time']['server_addr'] }}</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Composer Packages -->
    <div>
        <h2 class="text-xl font-semibold mb-3">Composer Packages</h2>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full  text-sm">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Package</th>
                        <th class="px-4 py-2 text-left">Version</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($info['composer'] as $name => $version)
                        <tr>
                            <td class="px-4 py-2">{{ $name }}</td>
                            <td class="px-4 py-2">{{ $version }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

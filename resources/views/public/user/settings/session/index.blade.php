@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        {{-- Sidebar --}}
        <div class="lg:col-span-1">
            @include('components.public.user.sidebar', ['user' => $user])
        </div>

        <div class="lg:col-span-3 space-y-6">

            <div class="bg-card rounded-xl border border-border shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-primary">
                        {{ __('public/user.sections.sessions') }}
                    </h2>

                </div>
                <div class="space-y-4">

                    @foreach ($sessions as $session)
                        <div class="flex items-center justify-between p-4 rounded-lg border border-border bg-background">

                            <div class="flex items-center gap-4">

                                <div
                                    class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary/10 text-primary">
                                    <i class="fas {{ $session->icon }}"></i>
                                </div>

                                <div class="space-y-1">

                                    <div class="font-medium">
                                        {{ $session->platform }} • {{ $session->browser }}
                                    </div>

                                    <div class="text-sm text-muted-foreground">
                                        {{ $session->device }} - IP: {{ $session->ip_address }}
                                    </div>

                                    <div class="text-xs text-muted-foreground">
                                        {{ __('public/user.fields.last_activity') }}:
                                        {{ $session->last_activity }}
                                    </div>

                                </div>

                            </div>

                            <div class="flex items-center gap-2">

                                @if ($session->is_current)
                                    <span
                                        class="h-10 px-4 flex items-center justify-center text-xs rounded-full bg-success/10 text-success font-medium">
                                        {{ __('public/user.fields.current_session') }}
                                    </span>
                                @else
                                    <form method="POST"
                                        action="{{ route('public.user.settings.session.delete', [$user, $session->id] ) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="{{ __('public/user.buttons.logout') }}"
                                            class="w-10 h-10 bg-danger text-danger-foreground rounded-lg hover:bg-danger/80">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endif

                            </div>

                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
@endsection

<aside class="m-4 flex flex-col">
    <div class="p-4 flex flex-col flex-grow justify-between  bg-surface border border-border shadow rounded-lg">
        <ul class="space-y-2 p-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.index') }}" class="link link-hover hover:underline">
                    <i class="fas fas fa-tachometer-alt mr-2"></i>{{ __('admin/dashboard.title') }}
                </a>
            </li>
            {{-- Posts --}}
            <li>
                <details class="group" open>
                    <summary class="cursor-pointer link link-hover hover:underline">
                        <i class="fa-solid fa-newspaper mr-2"></i>{{ __('admin/posts.title') }}
                    </summary>
                    <ul class="pl-8 pt-2 space-y-2">
                        <li>
                            <a href="{{ route('admin.post.index') }}" class="link link-hover hover:underline"><i
                                    class="fa-solid fa-newspaper mr-2"></i>{{ __('admin/posts.title') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.category.index') }}" class="link link-hover hover:underline"><i
                                    class="fa-solid fa-tag mr-2"></i>{{ __('admin/categories.title') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.tag.index') }}" class="link link-hover hover:underline"><i
                                    class="fa-solid fa-tags mr-2"></i>{{ __('admin/tags.title') }}</a>
                        </li>
                    </ul>
                </details>
            </li>
            {{-- Users --}}
            <li>
                <details class="group">
                    <summary class="cursor-pointer link link-hover hover:underline">
                        <i class="fa-solid fa-users mr-2"></i>{{ __('admin/users.title') }}
                    </summary>
                    <ul class="pl-8 pt-2 space-y-2">
                        <li>
                            <a href="{{ route('admin.user.index') }}" class="link link-hover hover:underline"><i
                                    class="fa-solid fa-users mr-2"></i>{{ __('admin/users.title') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.role.index') }}" class="link link-hover hover:underline"><i
                                    class="fas fa-user-plus mr-2"></i>{{ __('admin/roles.title') }}</a>
                        </li>
                    </ul>
                </details>
            </li>

            {{-- Settings --}}
            <li>
                <details class="group">
                    <summary class="cursor-pointer link link-hover hover:underline">
                        <i class="fas fa-cog mr-2"></i>{{ __('admin/settings.title') }}
                    </summary>
                    <ul class="pl-8 pt-2 space-y-2">
                        <li>
                            <a href="{{ route('admin.info.index') }}" class="link link-hover hover:underline"><i
                                    class="fas fa-server mr-2"></i>{{ __('admin/info.title') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.log.index') }}" class="link link-hover hover:underline"><i
                                    class="fa fa-history mr-2"></i>{{ __('admin/logs.title') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.footerlink.index') }}" class="link link-hover hover:underline"><i
                                    class="fas fa-cog mr-2"></i>{{ __('admin/footerlink.title') }}</a>
                        </li>
                    </ul>
                </details>
            </li>

            {{-- Icons --}}
            <li>
                <a href="https://fontawesome.com/" target="_blank" class="link link-hover hover:underline">
                    <i class="fa-solid fa-icons mr-2"></i>{{ __('admin/icons.title') }}</a>
            </li>
        </ul>
    </div>
    {{-- Availible Update --}}
    <x-admin.sidebar-update />



    {{-- User Profile --}}
    <div class="text-text-primary  bg-surface border border-border shadow  hover:shadow-md rounded-lg p-4 mt-4">
        <a href="{{ route('admin.user.show', Auth::user()->id) }}">
            <div class="flex items-center space-x-4">
                @if (Auth::user()->avatar)
                    <img id="userMenuButton" type="button" data-dropdown-toggle="userDropdown"
                        data-dropdown-placement="bottom-start"
                        class="relative inline-flex items-center justify-center w-10 h-10 object-cover rounded-full border border-border"
                        src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                @else
                    <div id="userMenuButton"
                        class="relative  inline-flex items-center justify-center w-10 h-10 overflow-hidden rounded-full border border-border">
                        <span class="font-medium">
                            {{ Auth::user()->getInitial() }}
                        </span>
                    </div>
                @endif
                <div>
                    <p class="text-sm font-semibold">{{ Auth::user()->login }}</p>
                    <p class="text-xs text-text-secondary">{{ Auth::user()->profile?->job_title }}</p>
                    <p class="text-xs text-text-secondary">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </a>
    </div>
</aside>

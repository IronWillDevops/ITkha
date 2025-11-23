<aside class="m-4 flex flex-col">
    <div
        class="p-4 flex flex-col flex-grow justify-between  bg-card text-card-foreground border border-border shadow rounded-lg">
        <ul class="space-y-2 p-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.index') }}"
                    class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="hover:underline">{{ __('admin/dashboard.title') }}</span>
                </a>
            </li>
            {{-- Posts --}}
            <li>
                <details class="group" open>
                    <summary
                        class="cursor-pointer hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                        <i class="fa-solid fa-newspaper"></i>
                        <span class="hover:underline">{{ __('admin/posts.title') }}</span>
                    </summary>
                    <ul class="pl-8 pt-2 space-y-2">
                        <li>
                            <a href="{{ route('admin.post.index') }}"
                                class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                <i class="fa-solid fa-newspaper"></i>
                                <span class="hover:underline">{{ __('admin/posts.title') }}</span></a>
                        </li>
                        <li>
                            <a href="{{ route('admin.category.index') }}"
                                class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                <i class="fa-solid fa-tag"></i>
                                <span class="hover:underline">{{ __('admin/categories.title') }}</span></a>
                        </li>
                        <li>
                            <a href="{{ route('admin.tag.index') }}"
                                class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                <i class="fa-solid fa-tags"></i>
                                <span class="hover:underline">{{ __('admin/tags.title') }}</span></a>
                        </li>
                        <li>
                            <a href="{{ route('admin.comment.index') }}"
                                class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                <i class="fa-solid fa-comments"></i>
                                <span class="hover:underline">{{ __('admin/comments.title') }}</span></a>
                        </li>
                    </ul>
                </details>
            </li>

            {{-- Users --}}
            <li>
                <details class="group">
                    <summary
                        class="cursor-pointer hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                        <i class="fa-solid fa-users "></i>
                        <span class="hover:underline">{{ __('admin/users.title') }}</span>
                    </summary>
                    <ul class="pl-8 pt-2 space-y-2">
                        <li>
                            <a href="{{ route('admin.user.index') }}"
                                class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                <i class="fa-solid fa-users"></i>
                                <span class="hover:underline">{{ __('admin/users.title') }}</span></a>
                        </li>
                        <li>
                            <a href="{{ route('admin.role.index') }}"
                                class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                <i class="fas fa-user-plus"></i>
                                <span class="hover:underline">{{ __('admin/roles.title') }}</span></a>
                        </li>
                    </ul>
                </details>
            </li>


            {{-- Contacts --}}
            <li>
                <a href="{{ route('admin.contact.index') }}"
                    class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                    <i class="fa-solid fa-envelope"></i>
                    <span class="hover:underline">{{ __('admin/contacts.title') }}</span></a>
            </li>


            {{-- Settings --}}
            <li>
                <details class="group">
                    <summary
                        class="cursor-pointer hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                        <i class="fas fa-cog"></i>
                        <span class="hover:underline">{{ __('admin/settings.title') }}</span>
                    </summary>

                    {{-- Main settings --}}
                    <ul class="pl-8 pt-2 space-y-2">
                        <li class="font-semibold text-sm text-text-secondary">{{ __('admin/settings.section.main') }}</li>

                        {{-- Site settings --}}
                        <li>
                            <a href="{{ route('admin.setting.site.edit') }}"
                                class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                <i class="fa-solid fa-globe"></i>
                                <span class="hover:underline">{{ __('admin/settings.site.title') }}</span>
                            </a>
                        </li>

                        {{-- User settings --}}
                        <li>
                            <a href="{{ route('admin.setting.user.edit') }}"
                                class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                <i class="fa-solid fa-users"></i>
                                <span class="hover:underline">{{ __('admin/users.title') }}</span>
                            </a>
                        </li>

                        {{-- Comment settings --}}
                        <li>
                            <a href="{{ route('admin.setting.comment.edit') }}"
                                class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                <i class="fa-solid fa-comments"></i>
                                <span class="hover:underline">{{ __('admin/comments.title') }}</span>
                            </a>
                        </li>
                    </ul>

                    {{-- Additional settings --}}
                    <ul class="pl-8 pt-2 space-y-2 mt-2">
                        <li class="font-semibold text-sm text-text-secondary">{{ __('admin/settings.section.additional') }}</li>

                        {{-- Footer links --}}
                        <li>
                            <a href="{{ route('admin.footerlink.index') }}"
                                class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                <i class="fas fa-cog"></i>
                                <span class="hover:underline">{{ __('admin/footerlink.title') }}</span>
                            </a>
                        </li>

                        {{-- Site info --}}
                        <li>
                            <a href="{{ route('admin.setting.info.index') }}"
                                class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                <i class="fas fa-server"></i>
                                <span class="hover:underline">{{ __('admin/info.title') }}</span>
                            </a>
                        </li>

                        {{-- Logs --}}
                        <li>
                            <a href="{{ route('admin.log.index') }}"
                                class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                <i class="fa fa-history"></i>
                                <span class="hover:underline">{{ __('admin/logs.title') }}</span>
                            </a>
                        </li>
                    </ul>

                    {{-- Integrations --}}
                    <ul class="pl-8 pt-2 space-y-2 mt-2">
                        <li class="font-semibold text-sm text-text-secondary">{{ __('admin/settings.section.integrations') }}</li>

                        {{-- Telegram integration --}}
                        <li>
                            <a href="{{ route('admin.setting.telegram.edit') }}"
                                class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                                <i class="fa-brands fa-telegram"></i>
                                <span class="hover:underline">Telegram</span>
                            </a>
                        </li>

                        {{-- Future integrations can be added here --}}
                    </ul>

                </details>
            </li>


            {{-- Icons --}}
            <li>
                <a href="https://fontawesome.com/" target="_blank"
                    class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                    <i class="fa-solid fa-icons"></i>
                    <span class="hover:underline">{{ __('admin/icons.title') }}</span></a>
            </li>
        </ul>
    </div>
    {{-- Availible Update --}}
    <x-admin.sidebar-update />



    {{-- User Profile --}}
    <div
        class="bg-card text-card-foreground  hover:bg-accent hover:text-accent-foreground border border-border shadow hover:shadow-md rounded-lg p-4 mt-4">
        <a href="{{ route('admin.user.show', Auth::user()) }}"
            class="flex items-center space-x-4 focus:ring focus:outline-none focus-visible:ring-ring ">

            @if (Auth::user()->avatar)
                <img id="userMenuButton" type="button" data-dropdown-toggle="userDropdown"
                    data-dropdown-placement="bottom-start"
                    class="relative inline-flex items-center justify-center w-10 h-10 object-cover rounded-full focus:ring focus:outline-none focus-visible:ring-ring border border-input"
                    src="{{ asset('storage/' . Auth::user()->avatar) }}" data-filename="image.png"
                    alt="{{ Auth::user()->name }}">
            @else
                <div id="userMenuButton"
                    class="bg-link hover:bg-accent hover:text-accent-foreground  relative inline-flex items-center justify-center w-10 h-10 overflow-hidden rounded-full focus:ring focus:outline-none focus-visible:ring-ring border border-input">
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

        </a>
    </div>
</aside>

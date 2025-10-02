<nav class="bg-card text-card-foreground  flex items-center gap-6 px-4 py-2 shadow rounded text-sm">
    <ul class="flex gap-2 m-0 p-0">
        <li>
            <a href="{{ route('admin.index') }}"
                class="rounded-sm bg-background border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 focus:ring focus:outline-none focus-visible:ring-ring">
                <i class="fa fa-tachometer-alt " aria-hidden="true"></i> {{ __('public/admin.dashboard') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.post.index') }}"
                class="rounded-sm bg-background border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 focus:ring focus:outline-none focus-visible:ring-ring">
                <i class="fa fa-newspaper " aria-hidden="true"></i> {{ __('public/admin.posts') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.user.index') }}"
                class="rounded-sm bg-background border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 focus:ring focus:outline-none focus-visible:ring-ring">
                <i class="fa fa-users " aria-hidden="true"></i> {{ __('public/admin.users') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.log.index') }}"
                class="rounded-sm bg-background border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 focus:ring focus:outline-none focus-visible:ring-ring">
                <i class="fa fa-history " aria-hidden="true"></i> {{ __('public/admin.logs') }}
            </a>
        </li>
    </ul>
</nav>

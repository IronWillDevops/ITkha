<nav class="bg-card text-card-foreground shadow rounded text-sm px-4 py-2  border-accent">
    <div class="flex items-center gap-3 mb-2 md:mb-0">
        <i class="fa fa-cogs" aria-hidden="true"></i>
        <span class="font-semibold">Admin Panel</span>
    </div>
    <ul class="flex flex-col md:flex-row gap-2">
        <li>
            <a href="{{ route('admin.index') }}"
               class="flex items-center gap-2 rounded-sm bg-background border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 focus:ring focus:outline-none focus-visible:ring-ring">
                <i class="fa fa-tachometer-alt" aria-hidden="true"></i> {{ __('public/admin.dashboard') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.post.index') }}"
               class="flex items-center gap-2 rounded-sm bg-background border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 focus:ring focus:outline-none focus-visible:ring-ring">
                <i class="fa fa-newspaper" aria-hidden="true"></i> {{ __('public/admin.posts') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.user.index') }}"
               class="flex items-center gap-2 rounded-sm bg-background border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 focus:ring focus:outline-none focus-visible:ring-ring">
                <i class="fa fa-users" aria-hidden="true"></i> {{ __('public/admin.users') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.log.index') }}"
               class="flex items-center gap-2 rounded-sm bg-background border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 focus:ring focus:outline-none focus-visible:ring-ring">
                <i class="fa fa-history" aria-hidden="true"></i> {{ __('public/admin.logs') }}
            </a>
        </li>
    </ul>
</nav>

<nav class="bg-card text-card-foreground  flex items-center gap-6 px-4 py-2 shadow rounded text-sm">
    <ul class="flex gap-2 m-0 p-0">
        <li>
            <a href="{{ route('admin.index') }}"
                class="rounded-sm bg-background border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 focus:ring focus:outline-none focus-visible:ring-ring">
                <i class="fa fa-tachometer-alt " aria-hidden="true"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.post.index') }}"
                class="rounded-sm bg-background border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 focus:ring focus:outline-none focus-visible:ring-ring">
                <i class="fa fa-newspaper " aria-hidden="true"></i> Posts
            </a>
        </li>
        <li>
            <a href="{{ route('admin.user.index') }}"
                class="rounded-sm bg-background border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 focus:ring focus:outline-none focus-visible:ring-ring">
                <i class="fa fa-users " aria-hidden="true"></i> Users
            </a>
        </li>
        <li>
            <a href="{{ route('admin.log.index') }}"
                class="rounded-sm bg-background border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 focus:ring focus:outline-none focus-visible:ring-ring">
                <i class="fa fa-history " aria-hidden="true"></i> Logs
            </a>
        </li>
    </ul>
</nav>

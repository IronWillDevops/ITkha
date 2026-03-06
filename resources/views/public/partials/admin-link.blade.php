<nav class="bg-card text-card-foreground shadow rounded text-sm px-4 py-2 border border-accent">
    <div class="flex items-center gap-3 mb-2 md:mb-0">
        <i class="fa fa-cogs" aria-hidden="true"></i>
        <span class="font-semibold">Admin Panel</span>
    </div>
    <ul class="flex flex-col md:flex-row gap-2">
        <li>
            <a href="{{ route('admin.index') }}"
               class="btn btn-shimmer">
                <i class="fa fa-tachometer-alt" aria-hidden="true"></i> {{ __('admin/dashboard.title') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.post.index') }}"
               class="btn btn-shimmer">
                <i class="fa fa-newspaper" aria-hidden="true"></i> {{ __('admin/post.title') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.user.index') }}"
               class="btn btn-shimmer">
                <i class="fa fa-users" aria-hidden="true"></i> {{ __('admin/user.title') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin.setting.logsactivity.index') }}"
               class="btn btn-shimmer">
                <i class="fa fa-history" aria-hidden="true"></i> {{ __('admin/settings/log.title') }}
            </a> 
        </li>
    </ul>
</nav>

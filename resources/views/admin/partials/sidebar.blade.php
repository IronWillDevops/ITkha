<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="{{ config('app.name') }} Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    @if (Auth::check())
                        <a href="{{ route('admin.user.show', auth()->user()->id) }}" class="d-block">
                            {{ Auth::user()->name }} {{ Auth::user()->surname }}
                        </a>
                    @endif
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if (auth()->user()->can('viewAny', \App\Models\Post::class) ||
                        auth()->user()->can('viewAny', \App\Models\Category::class) ||
                        auth()->user()->can('viewAny', \App\Models\Tag::class))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Posts
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            @can('viewAny', \App\Models\Post::class)
                                <li class="nav-item">
                                    <a href="{{ route('admin.post.index') }}" class="nav-link">
                                        <i class="fas fa-newspaper nav-icon"></i>
                                        <p>Posts

                                            <span class="badge badge-info right">
                                                {{ \App\Models\Post::count() }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('viewAny', App\Models\Category::class)
                                <li class="nav-item">
                                    <a href="{{ route('admin.category.index') }}" class="nav-link">
                                        <i class="fas fa-tag nav-icon"></i>
                                        <p>Categories
                                            <span class="badge badge-info right">
                                                {{ \App\Models\Category::count() }}</span>

                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('viewAny', App\Models\Tag::class)
                                <li class="nav-item">
                                    <a href="{{ route('admin.tag.index') }}" class="nav-link">
                                        <i class="fas fa-tags nav-icon"></i>
                                        <p>Tags
                                            <span class="badge badge-info right">{{ \App\Models\Tag::count() }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @if (auth()->user()->can('viewAny', \App\Models\User::class) || auth()->user()->can('viewAny', \App\Models\Role::class))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @can('viewAny', \App\Models\User::class)
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.user.index') }}" class="nav-link">
                                        <i class="fas fa-users nav-icon"></i>
                                        <p>Users
                                            <span class="badge badge-info right">{{ \App\Models\User::count() }}</span>
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                        @can('viewAny', \App\Models\Role::class)
                        <li class="nav-item">
                            <a href="{{ route('admin.role.index') }}" class="nav-link">
                                <i class="fas fa-users-cog nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                    @endcan


                    </li>
                @endif

                @if (auth()->user()->can('viewAny', \App\Models\Contact::class))
                    <li class="nav-item">
                        <a href="{{ route('admin.contact.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Messages
                                <span class="badge badge-info right">{{ \App\Models\Contact::count() }}</span>
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->can('viewAny', \App\Models\Log::class))
                    <li class="nav-item">
                        <a href="{{ route('admin.log.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-history"></i>
                            <p>
                                Logs
                                <span class="badge badge-info right"></span>
                            </p>
                        </a>
                    </li>
                @endif


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.settings.social.index') }}" class="nav-link">
                                <i class="fas fa-link nav-icon"></i>
                                <p>Social links</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{ route('admin.icons.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-icons"></i>
                        <p>
                            Icons
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

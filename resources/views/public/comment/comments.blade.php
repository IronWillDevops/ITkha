@foreach ($comments as $comment)
    <div class="ml-{{ $level ?? 0 }} border border-border p-2 rounded-lg mt-4 ">
        <div class="flex justify-between items-center mb-2">
            <div class="flex items-center gap-2">
                @if ($comment->user->singleMedia('avatar'))
                    <img id="userMenuButton" type="button" data-dropdown-toggle="userDropdown"
                        data-dropdown-placement="bottom-start"
                        class="relative inline-flex items-center justify-center w-10 h-10 object-cover rounded-full border border-border"
                        src="{{ asset('storage/' . $comment->user->singleMedia('avatar')) }}" data-filename="image.png"
                        alt="{{ $comment->user->name }}">
                @else
                    <div id="userMenuButton"
                        class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden rounded-full border border-border">
                        <span class="font-medium">
                            {{ $comment->user->getInitial() }}
                        </span>
                    </div>
                @endif

                <strong>
                    <a href="{{ route('public.user.show', $comment->user) }}" class="hover:underline font-medium">
                        {{ $comment->user->login }}
                    </a>
                </strong>

            </div>

            <small class="text-sm text-muted-foreground whitespace-nowrap">
                {{ $comment->created_at->diffForHumans() }}
                @if (Auth::check() && Auth::user()->hasPermission('comment.update'))
                    <a href="{{ route('admin.comment.edit', $comment->id) }}"
                        class="text-primary hover:text-primary/80 focus:ring focus:outline-none focus-visible:ring-ring">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                @endif
            </small>

        </div>

        <p class="mb-2 text-muted-foreground break-all">{{ $comment->body }}</p>

        @auth
            <a href="#comment-form"
                class="flex items-center gap-2 rounded-sm bg-background border border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 focus:ring focus:outline-none focus-visible:ring-ring w-64"
                onclick="moveForm({{ $comment->id }}, '{{ $comment->user->login }}', this)">
                <i class="fa-solid fa-reply"></i> {{ __('public/comment.buttons.reply') }}
            </a>
        @endauth

        <div id="comment-{{ $comment->id }}"></div>

        @if ($comment->children->isNotEmpty())
            @include('public.comment.comments', [
                'comments' => $comment->children,
                'post' => $post,
                'level' => ($level ?? 0) + 4,
            ])
        @endif
    </div>
@endforeach

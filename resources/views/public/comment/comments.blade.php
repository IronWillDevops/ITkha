@foreach ($comments as $comment)
    <div class="ml-{{ $level ?? 0 }} border border-border p-2 rounded-lg mt-4 ">
        <div class="flex justify-between items-center mb-2">
            <div class="flex items-center gap-2">
                @if (Auth::user()->singleMedia('avatar'))
                    <img class="w-10 h-10 object-cover rounded-full border border-input"
                        src="{{ Auth::user()->singleMedia('avatar')->url }}" alt="{{ Auth::user()->first_name }}">
                @else
                    <div
                        class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden rounded-full focus:ring focus:outline-none focus-visible:ring-ring border border-input">
                        <span class="font-medium">
                            {{ Auth::user()->getInitial() }}
                        </span>
                    </div>
                @endif

                <strong>
                    <a href="{{ route('public.user.show', $comment->user) }}" class="link">
                        {{ $comment->user->login }}
                    </a>
                </strong>

            </div>

            <small class="text-sm text-muted-foreground whitespace-nowrap">
                {{ $comment->created_at->diffForHumans() }}
                @if (Auth::check() && Auth::user()->hasPermission('comment.update'))
                    <a href="{{ route('admin.comment.edit', $comment->id) }}"
                        class="btn btn-primary btn-shimmer">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                @endif
            </small>

        </div>

        <p class="mb-2 text-muted-foreground break-all">{{ $comment->body }}</p>

        @auth
            <a href="#comment-form"
                class="btn btn-shimmer"
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

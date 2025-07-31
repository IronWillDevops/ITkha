@foreach ($comments as $comment)
    <div  class="ml-{{ $level ?? 0 }} border border-border p-2 rounded mt-4">
        
        <div class="flex justify-between items-start mb-2">
            <div class="flex items-center gap-2">
                @if ($comment->user->avatar)
                    <img id="userMenuButton" type="button" data-dropdown-toggle="userDropdown"
                        data-dropdown-placement="bottom-start"
                        class="relative inline-flex items-center justify-center w-10 h-10 object-cover rounded-full border border-border"
                        src="{{ asset('storage/' . $comment->user->avatar) }}" data-filename="image.png"
                        alt="{{ $comment->user->name }}">
                @else
                    <div id="userMenuButton"
                        class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden rounded-full border border-border">
                        <span class="font-medium">
                            {{ $comment->user->getInitial() }}
                        </span>
                    </div>
                @endif
                <strong><a href="{{ route('public.user.show',$comment->user->id) }}" class="post-link font-medium ">{{ $comment->user->login }}</a></strong>
            </div>
            <small class="text-sm text-text-muted whitespace-nowrap">
                {{ $comment->created_at->diffForHumans() }}
            </small>
        </div>

        <p class="mb-2 text-text-secondary">{{ $comment->body }}</p>

        <a href="#comment-form" class="link link-hover hover:underline"
            onclick="moveForm({{ $comment->id }}, '{{ $comment->user->login }}', this)">
            {{ __('post.comment.reply_title') }}
        </a>
       
        <div id="comment-{{ $comment->id }}" ></div>
       
        @if ($comment->children->isNotEmpty())
            @include('public.comment.comments', [
                'comments' => $comment->children,
                'post' => $post,
                'level' => ($level ?? 0) + 4,
            ])
        @endif
    </div>
@endforeach

 <section class=" bg-card text-card-foreground rounded-2xl border border-border">
     <div class="p-6">
         @if ($post->comments_enabled)
             <h2 class="text-2xl font-semibold mb-6">{{ __('post.comment.title') }}
                 ({{ $post->allApprovedComments()->count() }})</h2>
             <div id="default-comment-form">
                 @include('public.comment.form', ['post' => $post])
             </div>

             @include('public.comment.comments', [
                 'comments' => $post->comments->whereNull('parent_id'),
                 'post' => $post,
             ])
         @else
             <p class="text-muted">{{ __('post.comment.comments_disabled') }}</p>
         @endif
     </div>
 </section>

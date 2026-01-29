 <section class=" bg-card text-card-foreground rounded-2xl border border-border">
     <div class="p-6">
         <h2 class="text-2xl font-semibold mb-6">{{ __('public/comment.labels.title') }}
             ({{ $post->allApprovedComments()->count() }})</h2>
         @if ($post->comments_enabled)
             <div id="default-comment-form">
                 @include('public.comment.form', ['post' => $post])
             </div>
         @else
             <div class="my-4 rounded-md border border-border p-4 text-sm">
                 <p class="font-medium">
                     {{ __('public/comment.labels.comments_disabled') }}
                 </p>
             </div>
         @endif

         @include('public.comment.comments', [
             'comments' => $post->comments->whereNull('parent_id'),
             'post' => $post,
         ])

     </div>
 </section>

 <section class="mt-12 bg-surface rounded-2xl border border-border">
     <div class="p-6">
         <h2 class="text-2xl font-semibold mb-6">Similar posts</h2>
         <div class="text grid grid-cols-1 md:grid-cols-2 gap-6">
             @foreach ($similarPosts as $post)
                 <article
                     class="border border-border rounded-xl overflow-hidden flex flex-col hover:shadow-md transition">
                     @if (!empty($post->main_image) && Storage::disk('public')->exists($post->main_image))
                         <a href="{{ route('public.post.show', $post->id) }}" class="block w-full h-40 overflow-hidden">
                             <img src="{{ asset('storage/' . $post->main_image) }}" alt="post-image"
                                 class="w-full h-full object-cover  " />
                         </a>
                     @endif
                     <div class="p-4 flex flex-col flex-grow">
                         <h3 class=" font-bold mb-2 post-header post-header-hover text-hover">
                             <a href="{{ route('public.post.show', $post->id) }}" class="">
                                 {{ $post->title }}
                             </a>
                         </h3>
                         <p class="post-content text-sm mb-3">
                             {{ Str::limit(strip_tags($post->content), 250) }}</p>
                         <div class="flex flex-wrap items-center text-sm space-x-4 pt-2 mt-auto">

                             <span class="post-footer inline-flex items-center">
                                 <i class="fa fa-tag ml-2"></i>
                                 <span class="font-medium ml-2">{{ $post->category->title ?? '-' }}</span>
                             </span>

                             <span class="post-footer inline-flex items-center">
                                 <i class="fa fa-user ml-2"></i>
                                 <a href="{{ route('public.user.show', $post->author->id) ?? '#' }}"
                                     class="post-link font-medium ml-2">
                                     {{ $post->author->login ?? 'Author' }}
                                 </a>
                             </span>

                             <span class="post-footer inline-flex items-center">
                                 <i class="fa fa-clock ml-2"></i>
                                 <span class="font-medium ml-2">{{ $post->created_at->format('d/m/Y') ?? '-' }}</span>
                             </span>
                         </div>
                     </div>
                 </article>
             @endforeach
         </div>
     </div>
 </section>

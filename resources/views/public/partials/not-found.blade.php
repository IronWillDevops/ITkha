<div class="mt-8 grid grid-cols-1  bg-surface  text-text-primary border border-border rounded-lg gap-6">
    <div class="flex flex-col items-center justify-center py-20 px-6  rounded-md ">
        <i class="fa-solid fa-circle-exclamation fa-4x mb-4"></i>

        <h2 class="text-2xl font-semibold  mb-2">No posts found.</h2>
        <p class="text-text-secondary">No posts were found for your query.</p>

        <a href="{{ route('public.post.index') }}"
            class="inline-block mt-2 px-6 py-2 link link-hover  rounded transition">
            <i class="fas fa-home mr-4"></i>Return to home page
        </a>
    </div>
</div>

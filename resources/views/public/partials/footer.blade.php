<footer class="bg-surface text-text-primary  shadow border-solid border-t-1 border-border">
    <div class="px-4 py-6 md:flex md:items-center md:justify-between">
        <span class=" text-sm sm:text-center">
            &copy; 2024 - {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.
        </span>
        <div class="flex mt-4 sm:justify-center md:mt-0 space-x-5 rtl:space-x-reverse ">
            <a href=#>EN</a>
            <a href=#>UA</a> 
            @foreach (\App\Models\SocialLink::all() as $link)
                <a href="{{ $link->url }}" class="footer-btn footer-btn-hover" alt="{{ $link->title }}">
                    <i class=" fab {{ $link->icon }}"></i>
                </a>
            @endforeach
        </div>
    </div>
</footer>

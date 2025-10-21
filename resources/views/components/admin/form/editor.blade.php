<div class="text-card-foreground ">
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>

    <input id="{{ $name }}" type="hidden" name="{{ $name }}" value="{!! old($name, $value) !!}">
    <trix-toolbar id="editor-toolbar" class="text-card-foreground"></trix-toolbar>
    <trix-editor input="{{ $name }}" placeholder="{{ $placeholder }}" toolbar="editor-toolbar"  id="post-content"
        class=" trix-content caret-primary border border-input rounded-lg px-3 py-2 min-h-[400px] focus:ring focus:ring-primary focus:outline-none focus-visible:ring-ring"></trix-editor>

    @error($name)
        <p class="text-sm text-error mt-1">{{ $message }}</p>
    @enderror
</div>

@once
    @push('head')
        <link rel="stylesheet" href="https://unpkg.com/trix@2.1.15/dist/trix.css">
        <style>
            /* Общий стиль для кнопок: задать фон и цвет */
            trix-toolbar .trix-button {
                background-color: var(--color-card-foreground);
                color: white;
                background-image: none !important;
            }

            /* Цвет фона при активной кнопке */
            trix-toolbar .trix-button:active {
                background-color: var(--color-accent-foreground);
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/trix@2.1.15/dist/trix.umd.min.js"></script>

        <script>
            document.addEventListener("trix-attachment-add", function(event) {
                const attachment = event.attachment;

                if (attachment.file) {
                    uploadAttachment(attachment);
                }
            });

            document.addEventListener("trix-attachment-remove", function(event) {
                const attachment = event.attachment;
                const url = attachment.getAttribute("url");

                if (url) {
                    deleteAttachment(url);
                }
            });

            function uploadAttachment(attachment) {
                const file = attachment.file;
                const form = new FormData();
                form.append("file", file);

                fetch("{{ route('admin.post.image.upload') }}", {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: form
                    })
                    .then(response => response.json())
                    .then(result => {
                        attachment.setAttributes({
                            url: result.url,
                            href: result.url
                        });
                    })
                    .catch(error => {
                        console.error("Image upload failed:", error);
                    });
            }

            function deleteAttachment(url) {
                fetch("{{ route('admin.post.image.delete') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            url: url
                        })
                    })
                    .then(response => response.json())
                    .then(result => {
                        console.log("Image deleted:", result.message);
                    })
                    .catch(error => {
                        console.error("Image delete failed:", error);
                    });
            }
        </script>
    @endpush

@endonce

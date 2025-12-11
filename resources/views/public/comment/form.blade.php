<!-- resources/views/comments/form.blade.php -->

<form method="POST" action="{{ route('public.post.comment.store') }}" class="my-4">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    @if (isset($parentId))
        <input type="hidden" name="parent_id" value="{{ $parentId }}">
    @endif
    <div id="reply-to-info" class="my-2 hidden text-sm">
        {{ __('public/comment.labels.reply_to') }} <span id="reply-author" class="font-semibold"></span>
        <button type="button" onclick="cancelReply()"
            class=" hover:underline cursor-pointer">{{ __('public/comment.labels.reply_to_cancel') }}</button>
    </div>

    <x-form.area name="body" label="{{ __('public/comment.fields.write_comment') }}"
        placeholder="{{ __('public/comment.placeholder.write_comment') }}" />
        
    <x-public.form.captcha name="captcha" />

    <x-form.submit label="{{ __('public/comment.buttons.submit') }}" />

</form>


<script>
    function moveForm(commentId, authorLogin) {
        const form = document.querySelector('form[action="{{ route('public.post.comment.store') }}"]');
        const parentIdInput = form.querySelector('input[name="parent_id"]');

        if (!parentIdInput) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'parent_id';
            input.value = commentId;
            form.appendChild(input);
        } else {
            parentIdInput.value = commentId;
        }

        const replyInfo = document.getElementById('reply-to-info');
        const replyAuthor = document.getElementById('reply-author');
        replyAuthor.textContent = authorLogin;
        replyInfo.classList.remove('hidden');

        const commentElement = document.getElementById('comment-' + commentId);

        commentElement.after(form);
    }

    function cancelReply() {
        const form = document.querySelector('form[action="{{ route('public.post.comment.store') }}"]');
        const parentIdInput = form.querySelector('input[name="parent_id"]');

        if (parentIdInput) {
            parentIdInput.remove();
        }

        const replyInfo = document.getElementById('reply-to-info');
        replyInfo.classList.add('hidden');

        const defaultFormContainer = document.getElementById('default-comment-form');
        if (defaultFormContainer) {
            defaultFormContainer.appendChild(form);
        }
    }
</script>

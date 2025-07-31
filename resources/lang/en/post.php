<?php
return [
    'read_more' => 'Read more',
    'related_posts' => 'Related posts',
    'popular_posts' => 'Popular posts',
    'top_posts' => 'Top 5 posts',
    'not_found' => [
        'title' => 'No posts found.',
        'description' => 'No posts were found for your query.',
        'return_home' => 'Return to home page',
    ],
    'comment' =>
    [
        'title' => 'Comments',
        'write_comment' => 'Write a comment',
        'send' => 'Send',
        'placeholder' => 'Your comment...',
        'reply_title' => 'Reply',
        'reply_to' => 'Reply to comment',
        'reply_to_cancel' => 'cancel',
        'comment_added' => 'Comment added.',

        'post_id' => [
            'required' => 'The post ID is required.',
            'exists'   => 'The selected post does not exist.',
        ],

        'body' => [
            'required' => 'The comment body is required.',
            'string'   => 'The comment must be a valid string.',
            'min'      => 'The comment must be at least :min characters.',
            'max'      => 'The comment must not exceed :max characters.',
        ],

        'parent_id' => [
            'exists' => 'The comment you are replying to was not found.',
        ],

        'comments_disabled' => 'Comments on this post are disabled.',
    ],
];

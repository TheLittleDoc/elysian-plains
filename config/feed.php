<?php

return [
    'feeds' => [
        'main' => [
            'items' => 'App\Models\Post@getFeedItems',
            'format' => 'rss', // could be: 'rss', 'atom' or 'json'
            'view' => 'feed::rss',

            /*
             * The feed will be available on this url.
             */
            'url' => '/posts.rss',

            'title' => 'New Posts',
        ],
    ],
];

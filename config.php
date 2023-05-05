<?php

use Carbon\Carbon;
use TightenCo\Jigsaw\Collection\CollectionItem;

return [
    'production' => false,
    'baseUrl' => getenv('SVEN_PREVIEW_URL'),
    'title' => 'Sven Luijten',
    'description' => 'Hi 👋 — My name is Sven Luijten, and I am a full stack developer for the web.',
    'collections' => [
        'posts' => [
            'author' => 'Sven Luijten',
            'sort' => '-date',
            'path' => '/writing/{filename}',
            'minutesToRead' => function (CollectionItem $post): int {
                return round(str_word_count($post->getContent()) / 220);
            },
            'getDate' => function (CollectionItem $post, string $format, string $key = 'date') {
                return (new Carbon($post->{$key}))->format($format);
            },
        ],
    ],
];

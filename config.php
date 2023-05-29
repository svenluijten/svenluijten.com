<?php

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use TightenCo\Jigsaw\Collection\CollectionItem;

return [
    'production' => env('APP_ENVIRONMENT', 'local') === 'production',
    'baseUrl' => env('APP_PREVIEW_URL'),
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
            'previous' => function (CollectionItem $post) {
                return $post->collection
                    ->sortByDesc(fn (CollectionItem $item) => (new CarbonImmutable($item->date))->timestamp)
                    ->first(fn (CollectionItem $item) => (new CarbonImmutable($item->date))->lessThan(new CarbonImmutable($post->date)));
            },
            'next' => function (CollectionItem $post) {
                return $post->collection
                    ->sortByDesc(fn (CollectionItem $item) => (new CarbonImmutable($item->date))->timestamp)
                    ->last(fn (CollectionItem $item) => (new CarbonImmutable($item->date))->greaterThan(new CarbonImmutable($post->date)));
            },
        ],
    ],
];

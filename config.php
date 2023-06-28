<?php

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use TightenCo\Jigsaw\Collection\CollectionItem;
use TightenCo\Jigsaw\PageVariable;

return [
    'production' => env('APP_ENVIRONMENT', 'local') === 'production',
    'baseUrl' => env('APP_URL'),
    'title' => 'Sven Luijten',
    'description' => 'Hi 👋 — My name is Sven Luijten, and I am a full stack developer for the web.',
    'collections' => [
        'devPosts' => [
            'path' => '/dev/{filename}',
            'sort' => '-date',
            'minutesToRead' => function (CollectionItem $post): int {
                return round(str_word_count($post->getContent()) / 220);
            },
            'getDate' => function (CollectionItem $post, string $format, string $key = 'date') {
                return (new Carbon($post->{$key}))->format($format);
            },
            'previous' => function (CollectionItem $post) {
                return $post->collection
                    ->sortByDesc(fn(CollectionItem $item) => (new CarbonImmutable($item->date))->timestamp)
                    ->first(fn(CollectionItem $item) => (new CarbonImmutable($item->date))->lessThan(new CarbonImmutable($post->date)));
            },
            'next' => function (CollectionItem $post) {
                return $post->collection
                    ->sortByDesc(fn(CollectionItem $item) => (new CarbonImmutable($item->date))->timestamp)
                    ->last(fn(CollectionItem $item) => (new CarbonImmutable($item->date))->greaterThan(new CarbonImmutable($post->date)));
            },
        ],
        'photography' => [
            'path' => 'photography/{filename}',
        ],
        'concerts' => [
            'path' => 'concerts/{date|Y-m-d}/{filename}',
        ],
        'writing' => [
            'path' => 'writing/{filename}',
        ],
    ],
    'link' => function (PageVariable $page, string $path) {
        return rtrim($page->baseUrl, '/') . '/' . ltrim($path, '/');
    },
];

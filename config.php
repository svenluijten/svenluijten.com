<?php

use App\Concert;
use App\Post;
use Carbon\Carbon;
use TightenCo\Jigsaw\Collection\CollectionItem;
use TightenCo\Jigsaw\PageVariable;

return [
    'production' => false,
    'baseUrl' => 'http://localhost:8000',
    'title' => 'Sven Luijten',
    'buildTime' => new Carbon(),
    'collections' => [
        'posts' => [
            'path' => '/posts/{filename}',
            'sort' => '-date',
            'map' => fn ($post) => Post::fromItem($post),
        ],
        'concerts' => [
            'path' => '/concerts/{date|Y-m-d}/{filename}',
            'sort' => '-date',
            'map' => fn ($concert) => Concert::fromItem($concert),
        ],
    ],

    'getDate' => function (PageVariable $page, string $format, string $key = 'date'): string {
        return (new Carbon($page->{$key}))->format($format);
    },
    'link' => function (PageVariable $page, string $path) {
        return rtrim($page->baseUrl, '/') . '/' . ltrim($path, '/');
    },
    'groupByYear' => function (PageVariable $page, iterable $items) {
        return collect($items)->mapToGroups(function (CollectionItem $item) {
            return [$item->getDate('Y') => $item];
        })->sortByDesc(fn ($_, $year) => $year);
    }
];

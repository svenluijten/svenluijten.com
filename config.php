<?php

use App\Concert;
use App\Post;
use Carbon\Carbon;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkRenderer;
use TightenCo\Jigsaw\Collection\CollectionItem;
use TightenCo\Jigsaw\PageVariable;

return [
    'production' => false,
    'commonmark' => include './commonmark.php',
    'baseUrl' => 'http://localhost:8000',
    'title' => 'Sven Luijten',
    'description' => 'Full-stack developer, photographer, music lover, and lifter of heavy things.',
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

    'getDate' => static function (PageVariable $page, string $format, string $key = 'date'): string {
        return (new Carbon($page->{$key}))->format($format);
    },
    'link' => static function (PageVariable $page, string $path) {
        return rtrim($page->baseUrl, '/') . '/' . ltrim($path, '/');
    },
    'groupByYear' => static function (PageVariable $page, iterable $items) {
        return collect($items)
            ->sortByDesc(fn ($item) => $item->getDate('Y-m-d'))
            ->mapToGroups(function (CollectionItem $item) {
                return [$item->getDate('Y') => $item];
            });
    }
];

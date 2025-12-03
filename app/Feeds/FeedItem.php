<?php

namespace App\Feeds;

use DateTimeInterface;

readonly class FeedItem
{
    public function __construct(
        public string $id,
        public string $title,
        public string $url,
        public string $content,
        public DateTimeInterface $updated,
        public DateTimeInterface $published,
    ) {
    }
}

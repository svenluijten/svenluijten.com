<?php

namespace App;

use Carbon\CarbonImmutable;
use TightenCo\Jigsaw\Collection\CollectionItem;

class Post extends CollectionItem
{
    use HasReadingTime;
    use HasDate;

    public function id(): string
    {
        return md5($this->title . '_' . $this->getDate('Y-m-d'));
    }

    public function previous()
    {
        return $this->collection
            ->sortByDesc(fn(Post $item) => (new CarbonImmutable($item->date))->timestamp)
            ->first(fn(Post $item) => (new CarbonImmutable($item->date))->lessThan(new CarbonImmutable($this->date)));
    }

    public function next()
    {
        return $this->collection
            ->sortByDesc(fn(Post $item) => (new CarbonImmutable($item->date))->timestamp)
            ->last(fn(Post $item) => (new CarbonImmutable($item->date))->greaterThan(new CarbonImmutable($this->date)));
    }
}

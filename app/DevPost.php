<?php

namespace App;

use Carbon\CarbonImmutable;
use TightenCo\Jigsaw\Collection\CollectionItem;

class DevPost extends CollectionItem
{
    use HasReadingTime;
    use HasDate;

    public function previous()
    {
        return $this->collection
            ->sortByDesc(fn(CollectionItem $item) => (new CarbonImmutable($item->date))->timestamp)
            ->first(fn(CollectionItem $item) => (new CarbonImmutable($item->date))->lessThan(new CarbonImmutable($this->date)));
    }

    public function next()
    {
        return $this->collection
            ->sortByDesc(fn(CollectionItem $item) => (new CarbonImmutable($item->date))->timestamp)
            ->last(fn(CollectionItem $item) => (new CarbonImmutable($item->date))->greaterThan(new CarbonImmutable($this->date)));
    }
}

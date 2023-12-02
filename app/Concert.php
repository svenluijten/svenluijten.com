<?php

namespace App;

use Carbon\CarbonImmutable;
use TightenCo\Jigsaw\Collection\CollectionItem;

class Concert extends CollectionItem
{
    use HasReadingTime;
    use HasDate;

    public function id()
    {
        return md5($this->title . '_' . $this->getDate('Y-m-d'));
    }

    public function previous()
    {
        return $this->collection
            ->sortByDesc(fn(self $item) => (new CarbonImmutable($item->date))->timestamp)
            ->first(fn(self $item) => (new CarbonImmutable($item->date))->lessThan(new CarbonImmutable($this->date)));
    }

    public function next()
    {
        return $this->collection
            ->sortByDesc(fn(self $item) => (new CarbonImmutable($item->date))->timestamp)
            ->last(fn(self $item) => (new CarbonImmutable($item->date))->greaterThan(new CarbonImmutable($this->date)));
    }
}

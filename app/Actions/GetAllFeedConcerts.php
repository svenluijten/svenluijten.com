<?php

namespace App\Actions;

use App\Feeds\FeedItem;
use App\Makeable;
use App\Models\Concert;
use Illuminate\Support\Collection;

class GetAllFeedConcerts
{
    use Makeable;

    /**
     * @return \Illuminate\Support\Collection<FeedItem>
     */
    public function execute(): Collection
    {
        return Concert::query()
            ->where('published_at', '<=', now())
            ->orderByDesc('date')
            ->chunkMap(function (Concert $concert) {
                return new FeedItem(
                    id: $concert->feed_id,
                    title: $concert->title,
                    url: $concert->url,
                    content: $concert->content,
                    updated: $concert->updated_at,
                    published: $concert->published_at,
                );
            });
    }
}

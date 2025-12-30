<?php

namespace App\Actions;

use App\Feeds\FeedItem;
use App\Makeable;
use App\Models\BlogPost;
use Illuminate\Support\Collection;

class GetAllFeedBlogPosts
{
    use Makeable;

    /**
     * @return Collection<\App\Feeds\FeedItem>
     */
    public function execute(): Collection
    {
        return BlogPost::query()
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->chunkMap(function (BlogPost $blogPost) {
                return new FeedItem(
                    id: $blogPost->feed_id,
                    title: $blogPost->title,
                    url: route('blog.show', $blogPost),
                    content: $blogPost->content,
                    updated: $blogPost->updated_at,
                    published: $blogPost->published_at,
                );
            });
    }
}

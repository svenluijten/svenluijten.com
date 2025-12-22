<?php

namespace App\Actions;

use App\Makeable;
use App\Models\Concert;
use Illuminate\Support\Str;

class ReplaceRelativeLinksInConcerts
{
    use Makeable;

    public function execute(Concert $post): void
    {
        // 1. Find relative links in the content. These should be strings like `![alt](./slug.md)`
        preg_match_all('/\[(.*?)]\(\.\/(.*?)\.md\)/', $post->content, $matches, PREG_SET_ORDER);

        if (empty($matches)) {
            return;
        }

        $content = $post->content;

        foreach ($matches as $match) {
            $replace = './'.$match[2].'.md';

            // 2. Look up the linked-to concert or post by its slug.
            $concert = Concert::query()->where('slug', $match[2])->first();

            if ($concert === null) {
                return;
            }

            // 3. Replace the relative path with an absolute link in the content.
            $content = Str::replace($replace, $concert->url, $content);
        }

        $post->update(['content' => $content]);
    }
}

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
        // 1. Find relative links in the content. These should be strings starting with `<a href="./[anything].md">`
        preg_match_all('/href=\"\.\/(.+)\.md\"/i', $post->content, $matches);

        if (empty($matches[0])) {
            return;
        }

        $slug = $matches[1][0];
        $replace = $matches[0][0];

        // 2. Look up the linked-to concert or post by its slug.
        $concert = Concert::query()->where('slug', $slug)->first();

        if ($concert === null) {
            return;
        }

        // 3. Replace the relative path with an absolute link in the content.
        $newContent = Str::replace($replace, 'href="'.$concert->url.'"', $post->content);
        $post->update(['content' => $newContent]);
    }
}

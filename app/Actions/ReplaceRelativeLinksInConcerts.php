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
        preg_match_all('/href=\"\.\/(.+)\.md\"/Ui', $post->content, $matches);

        if (empty($matches[0])) {
            return;
        }

        $content = $post->content;

        foreach ($matches[1] as $key => $slug) {
            $replace = $matches[0][$key];

            // 2. Look up the linked-to concert or post by its slug.
            $concert = Concert::query()->where('slug', $slug)->first();

            if ($concert === null) {
                return;
            }

            // 3. Replace the relative path with an absolute link in the content.
            $content = Str::replace($replace, 'href="'.$concert->url.'"', $content);
        }

        $post->update(['content' => $content]);
    }
}

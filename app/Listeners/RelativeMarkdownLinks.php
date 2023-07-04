<?php

namespace App\Listeners;

use DOMDocument;
use Illuminate\Support\Str;
use TightenCo\Jigsaw\Collection\Collection;
use TightenCo\Jigsaw\Collection\CollectionItem;
use TightenCo\Jigsaw\Jigsaw;

class RelativeMarkdownLinks
{
    public function handle(Jigsaw $jigsaw): void
    {
        collect($jigsaw->getPages())
            ->filter(fn($page) => $page instanceof CollectionItem)
            ->each(function (CollectionItem $item) use ($jigsaw) {
                $itemFolderName = $item->getPath();
                $html = $jigsaw->readOutputFile($itemFolderName.'/index.html');

                $document = new DOMDocument();
                @$document->loadHTML($html);
                $container = $document->getElementById('post-content');

                if ($container === null) {
                    return;
                }

                /** @var \DOMElement[] $links */
                $links = $container->getElementsByTagName('a');

                foreach ($links as $link) {
                    $linkDestination = $link->getAttribute('href');

                    if (! $this->linkIsRelative($linkDestination)) {
                        continue;
                    }

                    $slug = $this->getSlugFromRelativeLink($linkDestination);

                    $newLink = $this->getPathForItem($slug, [$item->collection, ...$jigsaw->getCollections()]);

                    $link->setAttribute('href', $newLink);
                }

                $jigsaw->writeOutputFile($itemFolderName.'/index.html', $document->saveHTML());
            });
    }

    private function getSlugFromRelativeLink(string $relativeLink): string
    {
        $fileName = basename($relativeLink);

        return Str::before($fileName, '.md');
    }

    private function getPathForItem(string $slug, array $collections): string
    {
        /** @var Collection<string, CollectionItem> $collection */
        foreach ($collections as $collection) {
            if ($linkedItem = $collection->get($slug)) {
                return $linkedItem->getPath();
            }
        }

        throw new \RuntimeException('Could not get absolute link for "'.$slug.'".');
    }

    private function linkIsRelative(string $link): bool
    {
        return str_contains($link, './');
    }
}

<?php

namespace App\Listeners;

use DOMDocument;
use DOMElement;
use RuntimeException;
use TightenCo\Jigsaw\Collection\CollectionItem;
use TightenCo\Jigsaw\Jigsaw;

class SetSocialImagesForCollectionItems
{
    public function handle(Jigsaw $jigsaw)
    {
        collect($jigsaw->getPages())
            ->filter(fn($page) => $page instanceof CollectionItem)
            ->each(function (CollectionItem $item) use ($jigsaw) {
                $itemFolderName = $item->getPath();
                $html = $jigsaw->readOutputFile($itemFolderName.'/index.html');

                $document = new DOMDocument();
                @$document->loadHTML($html);

                try {
                    $socialImageUrl = $item->link($this->getSocialImage($document));

                    $ogElement = $document->getElementById('social-img-og');
                    $ogElement?->setAttribute('content', $socialImageUrl);
                    $ogElement?->removeAttribute('id');

                    $twElement = $document->getElementById('social-img-tw');
                    $twElement?->setAttribute('content', $socialImageUrl);
                    $twElement?->removeAttribute('id');

                    $jigsaw->writeOutputFile($itemFolderName.'/index.html', $document->saveHTML());
                } catch (RuntimeException $e) {
                    // no-op
                }
            });
    }

    private function getSocialImage(DOMDocument $document): string
    {
        $socialImage = $document->getElementById('social-image');

        if ($socialImage instanceof DOMElement) {
            return $socialImage->getAttribute('src');
        }

        [$firstImage] = $document->getElementsByTagName('img');

        if ($firstImage instanceof DOMElement) {
            return $firstImage->getAttribute('src');
        }

        throw new \RuntimeException('No social image to be found.');
    }
}

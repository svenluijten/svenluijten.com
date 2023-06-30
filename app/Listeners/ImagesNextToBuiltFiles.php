<?php

declare(strict_types=1);

namespace App\Listeners;

use DOMDocument;
use TightenCo\Jigsaw\Collection\CollectionItem;
use TightenCo\Jigsaw\Jigsaw;

class ImagesNextToBuiltFiles
{
    public function handle(Jigsaw $jigsaw): void
    {
        collect($jigsaw->getPages())
            ->filter(fn($page) => $page instanceof CollectionItem)
            ->each(function (CollectionItem $item) use ($jigsaw) {
                // Read the output file
                $itemFolderName = $item->getPath();
                $html = $jigsaw->readOutputFile($itemFolderName.'/index.html');

                // Scan the HTML for collection-specific images.
                $document = new DOMDocument();
                @$document->loadHTML($html);
                $container = $document->getElementById('post-content');

                if ($container === null) {
                    return;
                }

                /** @var \DOMElement[] $images */
                $images = $container->getElementsByTagName('img');

                foreach ($images as $image) {
                    if ($image->hasAttribute('keeplocation')) {
                        continue;
                    }

                    $originalImageLocation = $image->getAttribute('src');

                    // Move the image into the post's output folder.
                    $newImageLocation = $itemFolderName.'/'.basename($originalImageLocation);
                    $jigsaw->writeOutputFile($newImageLocation, $jigsaw->readOutputFile(ltrim($originalImageLocation, DIRECTORY_SEPARATOR)));

                    // Change the src of the image to the new path.
                    $image->setAttribute('src', $newImageLocation);
                }

                // Write the new HTML into the output file.
                $jigsaw->writeOutputFile($itemFolderName.'/index.html', $document->saveHTML());
            });
    }
}

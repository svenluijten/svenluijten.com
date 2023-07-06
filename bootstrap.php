<?php

use App\Listeners\ImagesNextToBuiltFiles;
use App\Listeners\RelativeMarkdownLinks;
use App\Listeners\SetSocialImagesForCollectionItems;
use TightenCo\Jigsaw\Jigsaw;

/** @var \Illuminate\Container\Container $container */
/** @var \TightenCo\Jigsaw\Events\EventBus $events */

/*
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */
$events->afterBuild(ImagesNextToBuiltFiles::class);
$events->afterBuild(RelativeMarkdownLinks::class);
$events->afterBuild(SetSocialImagesForCollectionItems::class);

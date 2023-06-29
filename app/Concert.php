<?php

namespace App;

use TightenCo\Jigsaw\Collection\CollectionItem;

class Concert extends CollectionItem
{
    use HasReadingTime;
    use HasDate;
}

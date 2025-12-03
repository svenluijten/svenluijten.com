<?php

namespace App\Http\Controllers\Feeds;

class Show
{
    public function __invoke()
    {
        // 1. Every hour, a command should be fired to (re)generate the feeds.
        // 2. This command creates static files that are served directly by NGINX.
    }
}

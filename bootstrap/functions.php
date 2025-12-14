<?php

if (! function_exists('oggy')) {
    function oggy(string $title, string $subtitle): string
    {
        $query = http_build_query(['title' => $title, 'subtitle' => $subtitle]);

        return config('services.oggy.url').'?'.$query;
    }
}

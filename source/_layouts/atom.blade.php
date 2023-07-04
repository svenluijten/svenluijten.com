<?php echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <id>@yield('id')</id>
    <title>@yield('title')</title>
    <subtitle>@yield('subtitle')</subtitle>
    <updated>{{ $page->buildTime->format('Y-m-d\TH:i\Z') }}</updated>
    @yield('links')

    <author>
        <name>Sven Luijten</name>
    </author>

    @yield('entries')
</feed>

<entry>
    <id>{{ $entry->getUrl() }}</id>
    <title>{{ $entry->title }}</title>
    <summary>{{ $entry->excerpt ?? $entry->summary }}</summary>
    <updated>{{ (new \Carbon\Carbon($entry->updated ?? $entry->date))->format('Y-m-d\T00:00\Z') }}</updated>
    <author>
        <name>Sven Luijten</name>
    </author>
    <link href="{{ $entry->getUrl() }}" rel="alternate" type="text/html" />
    <published>{{ (new \Carbon\Carbon($entry->date))->format('Y-m-d\T00:00\Z') }}</published>
</entry>

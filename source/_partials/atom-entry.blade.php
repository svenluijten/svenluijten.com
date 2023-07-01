<entry>
    <id>{{ $entry->getUrl() }}</id>
    <title>{{ $entry->title }}</title>
    <updated>{{ (new \Carbon\Carbon($entry->updated ?? $entry->date))->format('Y-m-d\TH:i:s\Z') }}</updated>
    <author>
        <name>Sven Luijten</name>
    </author>
    <link href="{{ $entry->getUrl() }}" rel="alternate" type="text/html" />
    <published>{{ (new \Carbon\Carbon($entry->date))->format('Y-m-d') }}</published>
</entry>

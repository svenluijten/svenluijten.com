@php
    echo '<?xml version="1.0" encoding="utf-8"?>'.PHP_EOL;
@endphp
<feed xmlns="http://www.w3.org/2005/Atom">
    <id>{{ $id }}</id>
    <title>{{ $title }}</title>
    <subtitle>{{ $subtitle }}</subtitle>
    <updated>{{ $updated->format(DateTimeInterface::ATOM) }}</updated>
    <link rel="self" href="{{ $self }}" type="application/xml+atom"/>
    @if ($html)<link rel="alternate" href="{{ $html }}" type="text/html"/>@endif
    <author>
        <name>Sven Luijten</name>
    </author>
@foreach ($entries as $entry)
    <entry>
        <id>{{ $entry->id }}</id>
        <title>{{ $entry->title }}</title>
        <updated>{{ $entry->updated->format(DateTimeInterface::ATOM) }}</updated>
        <author>
            <name>Sven Luijten</name>
        </author>
        <published>{{ $entry->published->format(DateTimeInterface::ATOM) }}</published>
        <link href="{{ $entry->url }}" rel="alternate" type="text/html"/>
    </entry>
@endforeach
</feed>

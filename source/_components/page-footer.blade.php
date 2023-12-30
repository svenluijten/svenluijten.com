@props(['title', 'page'])

<footer>
    <h1 id="{{ str($title)->kebab() }}">{{ $title }}</h1>
    <nav aria-label="Previous and next post(s) if available">
        <ul role="menu" aria-labelledby="{{ str($title)->kebab() }}">
            @if ($page->previous())
                <li>
                    Previous: <a href="{{ $page->previous()->getUrl() }}">{{ $page->previous()->title }}</a>
                </li>
            @endif

            @if ($page->next())
                <li>
                    Next: <a href="{{ $page->next()->getUrl() }}">{{ $page->next()->title }}</a>
                </li>
            @endif
        </ul>
    </nav>
</footer>

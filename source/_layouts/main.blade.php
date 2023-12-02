<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

{{--        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">--}}

        <!-- Theme colors -->
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="cyan">
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="black">

        <title>@yield('title') &bull; Sven Luijten</title>
    </head>

    <body>
        <header aria-label="">
            <nav aria-label="Primary navigation">
                <section>
                    <a href="{{ $page->link('/') }}">Sven Luijten</a>
                </section>

                <ul>
                    <li>
                        <a href="{{ $page->link('posts') }}">Blog</a>
                    </li>
                    <li>
                        <a href="{{ $page->link('concerts') }}">Concerts</a>
                    </li>
                </ul>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            <section>
                &copy;
                <a href="{{ $page->link('/') }}">Sven Luijten</a>
            </section>

            <nav aria-label="Footer navigation">
                <ul>
                    <li>
                        <a href="https://github.com/svenluijten">GitHub</a>
                    </li>
                    <li>
                        <a href="https://mas.to/@svenluijten">Mastodon</a>
                    </li>
                    <li>
                        <a href="https://luijten.photography/">Photography</a>
                    </li>
                </ul>

                <ul>
                    <li>
                        <a href="{{ $page->link('now') }}">Now</a>
                    </li>
                    <li>
                        <a href="{{ $page->link('uses') }}">Uses</a>
                    </li>
                    <li>
                        <a href="{{ $page->link('feeds') }}">Feeds</a>
                    </li>
                </ul>
            </nav>
        </footer>
    </body>
</html>

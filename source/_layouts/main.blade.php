<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">

        <!-- Theme colors -->
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="cyan">
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="black">

        <title>@yield('title') &bull; Sven Luijten</title>
    </head>

    <body class="font-sans bg-white min-h-screen relative antialiased | dark:bg-gray-900 dark:text-gray-200">
        <div class="fixed w-full border-b-4 border-indigo-700 shadow-md shadow-indigo-300 | dark:shadow-indigo-950"></div>

        <header aria-label="" class="container">
            <div class="mx-auto w-full items-center py-4 px-6 lg:w-2/3">
                <nav aria-label="Primary navigation" class="flex flex-row justify-between items-center">
                    <section>
                        <a href="{{ $page->link('/') }}" class="text-xl font-bold">
                            Sven Luijten
                        </a>
                    </section>

                    <ul class="flex flex-row">
                        <li class="mr-4">
                            <span class="mr-0.5 font-bold no-underline" aria-hidden="true">&rsaquo;</span>
                            <a href="{{ $page->link('posts') }}" class="underline hover:no-underline">Blog</a>
                        </li>

                        <li>
                            <span class="mr-0.5 font-bold no-underline" aria-hidden="true">&rsaquo;</span>
                            <a href="{{ $page->link('concerts') }}" class="underline hover:no-underline">Concerts</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <main class="container">
            <div class="mx-auto w-full items-center py-4 px-6 lg:w-2/3">
                @yield('content')
            </div>
        </main>

        <footer class="container">
            <div class="mx-auto w-full items-start py-4 px-6 lg:w-2/3 flex flex-row justify-between">
                <section>
                    &copy;
                    <a href="{{ $page->link('/') }}">Sven Luijten</a>
                </section>

                <nav aria-label="Footer navigation" class="flex flex-row justify-around">
                    <ul class="mr-8">
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

                    <ul>
                        <li>
                            <a href="https://github.com/svenluijten">GitHub</a>
                        </li>

                        <li>
                            <a href="https://mas.to/@svenluijten" rel="me">Mastodon</a>
                        </li>

                        <li>
                            <a href="https://luijten.photography/">Photography</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </footer>
    </body>
</html>

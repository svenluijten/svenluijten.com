<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

        <link rel="preconnect" href="https://fonts.bunny.net">

        <link href="https://fonts.bunny.net/css?family=jetbrains-mono:500,500i|montserrat:500,500i|source-serif-4:500,500i" rel="stylesheet" />

        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
        @stack('styles')

        <!-- Theme colors -->
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="cyan">
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="black">

        <title>@yield('title') &bull; Sven Luijten</title>
    </head>

    <body class="font-serif bg-gray-100 min-h-screen relative antialiased | dark:bg-gray-900 dark:text-gray-200">
        <div class="fixed w-full border-b-4 border-indigo-700 shadow-md shadow-indigo-300 | dark:shadow-indigo-950"></div>

        <header aria-label="" class="container pt-3">
            <div class="mx-auto w-full items-center py-4 px-6 lg:w-2/3">
                <nav aria-label="Primary navigation" class="flex flex-row justify-between items-center">
                    <section>
                        <a href="{{ $page->link('/') }}" class="text-xl font-sans font-bold p-4 -m-4">
                            Sven Luijten
                        </a>
                    </section>

                    <ul class="flex flex-row">
                        <li class="mr-4">
                            <span class="mr-0.5 font-sans font-bold no-underline" aria-hidden="true">&rsaquo;</span>
                            <a href="{{ $page->link('posts') }}" class="font-sans p-4 -m-4 underline hover:no-underline">Blog</a>
                        </li>


                        <li>
                            <span class="mr-0.5 font-sans font-bold no-underline" aria-hidden="true">&rsaquo;</span>
                            <a href="{{ $page->link('concerts') }}" class="font-sans p-4 -m-4 underline hover:no-underline">Concerts</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <main class="container">
            <div class="mx-auto w-full items-center px-6 lg:w-2/3">
                @yield('content')
            </div>
        </main>

        <footer class="container font-sans mt-8">
            <div class="mx-auto w-full items-start py-4 px-6 lg:w-2/3 flex flex-row justify-between">
                <section>
                    &copy;
                    <a href="{{ $page->link('/') }}">Sven Luijten</a>
                </section>

                <nav aria-label="Footer navigation" class="flex flex-row justify-around">
                    <ul class="mr-8">
                        <li>
                            <a href="{{ $page->link('now') }}" class="link">Now</a>
                        </li>

                        <li>
                            <a href="{{ $page->link('uses') }}" class="link">Uses</a>
                        </li>

                        <li>
                            <a href="{{ $page->link('feeds') }}" class="link">Feeds</a>
                        </li>
                    </ul>

                    <ul>
                        <li>
                            <a href="https://github.com/svenluijten" class="link">GitHub</a>
                        </li>

                        <li>
                            <a href="https://mas.to/@svenluijten" rel="me" class="link">Mastodon</a>
                        </li>

                        <li>
                            <a href="https://luijten.photography/" class="link">Photography</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </footer>
    </body>

    @stack('scripts')
</html>

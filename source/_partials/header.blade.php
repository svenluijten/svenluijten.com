<header class="container">
    <div class="mx-auto w-full flex flex-row items-center justify-between py-4 px-6 | lg:w-2/3 lg:px-0 md:pt-12 md:pb-6">
        <a href="/" class="text-2xl font-extrabold justify-center text-black hover:text-black hover:no-underline | dark:text-gray-100 dark:hover:text-indigo-100">
            Sven Luijten
        </a>

        <nav>
            <ul class="flex justify-center text-lg">
                <li class="px-2">
                    <a href="{{ $page->link('posts') }}"
                       class="font-bold text-gray-600 py-1 | hover:no-underline dark:text-indigo-100"
                    >
                        <span class="text-indigo-700 dark:text-indigo-300">//</span>
                        Blog
                    </a>
                </li>

                <li class="px-2">
                    <a href="{{ $page->link('concerts') }}"
                       class="font-bold text-gray-600 py-1 | hover:no-underline dark:text-indigo-100"
                    >
                        <span class="text-indigo-700 dark:text-indigo-300">//</span>
                        Concerts
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<header class="container">
    <div class="mx-auto w-full flex flex-row items-center justify-between py-4 px-6 | lg:w-2/3 lg:px-0 md:pt-12 md:pb-6">
        <a href="/" class="text-2xl font-extrabold justify-center text-black hover:text-black hover:no-underline | dark:text-gray-100 dark:hover:text-indigo-100">
            Sven Luijten
        </a>

        <nav>
            <ul class="flex justify-center text-lg">
                <li class="px-2 | lg:px-4">
                    <a href="{{ $page->link('posts') }}"
                       class="font-bold text-gray-600 px-4 py-2 border-b-4 border-indigo-200 | hover:no-underline hover:text-indigo-50 hover:border-indigo-600 hover:bg-indigo-500 dark:text-indigo-100 dark:border-indigo-500"
                    >
                        Blog
                    </a>
                </li>

                <li class="px-2 | lg:px-4">
                    <a href="{{ $page->link('concerts') }}"
                       class="font-bold text-gray-600 px-4 py-2 border-b-4 border-indigo-200 | hover:no-underline hover:text-indigo-50 hover:border-indigo-600 hover:bg-indigo-500 dark:text-indigo-100 dark:border-indigo-500"
                    >
                        Concerts
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

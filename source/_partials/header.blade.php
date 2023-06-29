<header class="container mx-auto">
    <div class="mx-auto w-full flex flex-col items-center justify-between py-4 px-6 | sm:flex-row lg:w-3/5 lg:px-0 md:pt-12 md:pb-6">
        <a href="/" class="text-2xl font-extrabold justify-center text-black hover:text-black hover:no-underline | dark:text-indigo-100">
            Sven Luijten
        </a>

        <nav class="w-full mt-3 | sm:w-auto sm:mt-0">
            <ul class="flex justify-center text-lg">
                <li class="px-2 | lg:px-4">
                    <a href="{{ $page->link('dev') }}"
                       class="font-bold text-gray-600 px-4 py-2 border-b-4 border-indigo-200 | hover:no-underline hover:text-indigo-50 hover:border-indigo-600 hover:bg-indigo-500 dark:text-indigo-100 dark:border-indigo-500"
                    >
                        Development
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

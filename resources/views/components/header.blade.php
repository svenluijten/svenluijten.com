<div>
    <div class="bg-secondary h-1 w-full hover:animate-pulse"></div>
</div>

<header class="container font-system mb-4">
    <div class="mx-auto w-full flex flex-row items-center justify-between py-2 px-2 | lg:w-2/3 lg:px-0 md:py-4">
        <a href="{{ route('home') }}" class="group">
            <img src="{{ url('/images/logo.svg') }}" alt="Sven Luijten" class="w-12 h-12 group-hover:scale-105 group-hover:rotate-6 transition-all duration-75">
        </a>

        <nav>
            <ul class="flex justify-center text-lg">
                <li class="px-2 | lg:px-4">
                    <a href="{{ route('contact') }}" class="underline-offset-2 hover:underline">
                        Contact
                    </a>
                </li>

                <li class="px-2 | lg:px-4">
                    <a href="{{ route('explore') }}" class="underline-offset-2 hover:underline">
                        Explore
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

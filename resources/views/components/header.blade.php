<header>
    <x-container class="flex flex-row items-center justify-between py-5">
        <a href="{{ route('home') }}" class="group">
            <img
                src="{{ url('/images/logo.svg') }}"
                alt="Sven Luijten"
                class="h-11 w-11 transition-transform duration-150 group-hover:rotate-6 group-hover:scale-105"
            >
        </a>

        <nav>
            <ul class="flex items-center gap-6">
                <li>
                    <a href="{{ route('contact') }}" class="decoration-secondary decoration-2 underline-offset-[3px] hover:underline">
                        Contact
                    </a>
                </li>

                <li>
                    <a href="{{ route('explore') }}" class="decoration-secondary decoration-2 underline-offset-[3px] hover:underline">
                        Explore
                    </a>
                </li>
            </ul>
        </nav>
    </x-container>
</header>

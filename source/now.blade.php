@extends('_layouts.main')

@section('title', 'Now')

@section('content')
    <header class="text-center my-2">
        <picture>
            <img src="https://picsum.photos/640/144" alt="..." class="w-full h-36 mb-4" loading="lazy">
        </picture>


        <h1 class="text-3xl font-bold mb-4">What I'm up to</h1>
        <div class="text-sm my-4 dark:text-gray-400">
            Last updated:

            <time datetime="2024-03-01" title="2024-03-01">
                March 1st, 2024
            </time>
        </div>

        <p>
            Check out <a class="link" href="https://nownownow.com/" target="_blank">nownownow.com</a> for other
            <code class="inline">now</code> pages.
        </p>
    </header>

    <x-separator color="indigo-700" />

    <main class="prose lg:prose-xl dark:prose-invert">
        <h2>Work</h2>
        <p>
            I'm currently working as a full time PHP developer at <a href="https://onlinepaymentplatform.com">Online Payment Platform</a>,
            making the world of online payments easier every day. On the side I'm continuously tweaking this website and
            maintaining <a href="https://github.com/svenluijten?tab=repositories">my open source packages</a>. I don't
            have any major code-projects planned for now.
        </p>

        <h2>Health</h2>
        <ul>
            <li>Lifting 4 times a week.</li>
            <li>2024 goal is to get all my big lifts (bench, squat, deadlift) up to at least 100kg.</li>
            <li>Cardio trend has been going down lately, working on getting that back up by taking long(er) walks.</li>
        </ul>

        <h2>Life</h2>
        <ul>
            <li>Buying a house (!)</li>
            <li>Spending time with the people I love.</li>
        </ul>
    </main>
@endsection

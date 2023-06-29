@extends('_layouts.main')

@section('content')
    <div class="flex flex-col justify-center items-center lg:flex-row">
        <img src="/assets/images/headshot.jpg"
             alt="A headshot of an insanely handsome developer looking at the camera with a strapping smile."
             class="w-64 h-64 my-4 rounded-full border-4 border-gray-100 shadow | lg:my-0 lg:-ml-52 lg:w-48 lg:h-48 dark:border-gray-700"
        >

        <div class="lg:px-4">
            <h1 class="text-3xl font-bold">Hi 👋 — My name is Sven Luijten</h1>
            <p class="mb-4">
                and I am a full stack developer for the web, a photographer, and lifter of heavy things. From an early
                age, I became interested in everything to do with computers. To dismay of my parents, I hacked away at
                the family computer, took apart video players to try and figure out how they worked, and wrote small
                scripts to impress my classmates.
            </p>
        </div>
    </div>

    <p class="mb-4">
        This led to me eventually going to school to write code, which is where I got introduced to PHP and
        eventually the <a href="https://laravel.com">Laravel framework</a>, which I am still a big fan of to
        this day! I often <a href="https://github.com/svenluijten">contribute to open source projects and
            packages</a> and also <a href="https://github.com/svenluijten?tab=repositories">maintain several of
            my own</a>.
    </p>

    <p class="mb-4">
        I am nearly always capturing what's around me with either my phone or my camera, both for pleasure and in a
        professional capacity. You can view some of my work on <a href="https://instagram.com/luijten.photography">
            Instagram</a> or read about the shoots I do on <a href="https://luijten.photography">my (Dutch)
            photography blog</a>.
    </p>

    <p class="mb-4">
        I also keep <a href="{{ $page->link('concerts') }}">a concert log</a> and do some
        <a href="{{ $page->link('writing') }}">general writing</a> on this site.
    </p>

    <p class="mb-4">
        If you would like to get in touch, you can do so <a href="mailto:contact@svenluijten.com">via email</a>.
    </p>

    <p class="text-gray-600 bg-indigo-100 border rounded border-indigo-200 py-2 px-4 -mx-4 | dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
        <strong>Note</strong>: if you spot any tyop on this site, <a href="https://github.com/svenluijten/sven.is">it is
            open source</a>,
        so feel free submit a pull request to fix it!
    </p>
@endsection

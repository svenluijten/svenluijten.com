@extends('_layouts.main')

@section('content')
    <div class="flex flex-col justify-center items-center lg:flex-row">
        <img src="/assets/images/headshot.jpg"
             alt="A headshot of an insanely handsome developer looking at the camera with a strapping smile."
             class="w-64 h-64 my-4 rounded-full border-4 border-gray-100 shadow | lg:my-0 lg:-ml-24 lg:w-48 lg:h-48 dark:border-gray-700"
        >

        <div class="lg:px-4 something">
            <h1 class="text-3xl font-bold">Hi 👋 — My name is Sven Luijten</h1>
            <p class="mb-4">
                and I am a full stack developer for the web. I got my start in the <a href="https://laravel.com">Laravel
                    framework</a>,
                which I am still a big fan of to this day! I often <a href="https://github.com/svenluijten">contribute
                    to open source projects and packages</a>
                and also <a href="https://github.com/svenluijten?tab=repositories">maintain several of my own</a>.
            </p>
        </div>
    </div>

    <p class="mb-4">
        My aim is to write elegant, easy-to-follow, and maintainable code, always using the best tool for the job.
        So far, I have had the privilege of working with a lot of tools and technologies, including:
    </p>

    <blockquote class="border-l-4 border-gray-300 pl-3 mb-4">
        PHP, Java, Golang, Javascript, Laravel, Docker, Git, MySQL, TailwindCSS, Vue.js, React, Kubernetes,
        Spring Boot, GitHub, GitLab, Jira, PhpStorm, REST APIs, OpenAPI, Postman, StoplightIO, ...
    </blockquote>

    <p class="mb-4">
        If you want to know what hard- and software I use on a day-to-day basis, feel free to check out my
        <a href="{{ $page->link('using') }}">uses page</a>.
    </p>

    <p class="mb-4">
        If you would like to get in touch, you can do so <a href="mailto:contact@svenluijten.com">via email</a>.
        You can also visit <a href="https://github.com/svenluijten">my GitHub profile</a> to see my contributions
        and open source libraries I have worked on over time.
    </p>

    <p class="text-gray-600 bg-indigo-100 border rounded border-indigo-200 py-2 px-4 -mx-4 | dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
        <strong>Note</strong>: if you spot any tyop on this site, <a href="https://github.com/svenluijten/sven.is">it is
            open source</a>,
        so feel free submit a pull request to fix it!
    </p>
@endsection

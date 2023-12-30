---
title: Sunsetting Artisan View
date: 2023-10-14
excerpt: Discontinuing my most popular Laravel package
extends: _layouts.post
section: body
---

Undoubtedly my most popular package (and the one I'm most proud of!)
[`sven/artisan-view`](https://github.com/svenluijten/artisan-view) has been abandoned and archived.

After 7 and a half years and more than 600,000 downloads later, it's time to shut it down. Laravel now includes a
`make:view` command since [v10.23.0](https://github.com/laravel/framework/releases/tag/v10.23.0), so I highly encourage
you to update and use that instead! For applications running on any version _below_ v10.23.0, `sven/artisan-view` will
still be available to install.

And for what it's worth: I absolutely _love_ that the framework now has first-party support for generating view files!
It was [the highest upvoted issue on `laravel/ideas`](https://github.com/laravel/ideas/issues/241) for a long time, so
I'm very happy to finally see it make its way into Laravel.

I still have several other open source packages that I maintain [on my GitHub profile](https://github.com/svenluijten),
and I'm sure I'll make more as I encounter problems in my day-to-day job. I'm very thankful that a silly package I made
while I was in college was used by so many people and projects.

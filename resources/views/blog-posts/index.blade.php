@php use Illuminate\Support\Str; @endphp
<x-layout title="Blog posts" description="Sven's blog posts">
    <x-slot:meta>
        <link href="{{ url('/feeds/blog-posts.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten's Blog Posts">
    </x-slot>

    <div class="my-8 space-y-12">
        @foreach($blogPosts as $year => $posts)
            <div class="relative flex flex-col gap-2 | md:flex-row md:gap-8">
                <div class="w-24 shrink-0 pt-3 | md:text-right">
                    <div class="sticky top-2">
                        <span class="font-heading text-4xl">{{ $year }}</span>
                        <div class="mt-1 text-sm text-ink-muted">{{ count($posts) }} {{ Str::plural('post', count($posts)) }}</div>
                    </div>
                </div>

                <div class="relative hidden w-px shrink-0 bg-line-strong | md:block"></div>

                <div class="flex-1 space-y-6">
                    @foreach($posts as $post)
                        <div class="relative">
                            {{-- Timeline node: centred on the vertical rule, 40px left of the card. --}}
                            <div class="absolute -left-10 top-8 hidden h-4 w-4 rounded-full border-4 border-primary bg-surface | md:block"></div>

                            <a
                                href="{{ route('blog.show', $post->slug) }}"
                                class="block rounded-card border border-line bg-surface p-6 shadow-card transition duration-150 | hover:border-line-strong hover:shadow-card-hover"
                            >
                                <div class="mb-2 flex items-start justify-between gap-4">
                                    <h3>{{ $post->title }}</h3>

                                    <time datetime="{{ $post->published_at->toDateString() }}" class="shrink-0 whitespace-nowrap pt-1 text-sm text-ink-muted">
                                        {{ $post->published_at->format('M j') }}
                                    </time>
                                </div>

                                <p class="font-text leading-relaxed text-ink-muted">{{ $post->preview }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</x-layout>

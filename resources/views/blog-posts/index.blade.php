@php use Illuminate\Support\Str; @endphp
<x-layout title="Blog posts" description="Sven's blog posts">
    <x-slot:meta>
        <link href="{{ url('/feeds/blog-posts.xml') }}" type="application/atom+xml" rel="alternate" title="Sven Luijten's Blog Posts">
    </x-slot>

    <div class="flex gap-8 my-8">
        <div class="flex-1 space-y-12">
            @foreach($blogPosts as $year => $posts)
                <div class="flex gap-8 relative">
                    <div class="w-24 shrink-0 text-right pt-3">
                        <div class="sticky top-2">
                            <span class="text-4xl font-heading text-gray-900">{{ $year }}</span>
                            <div class="text-sm text-gray-500 mt-1">{{ count($posts) }} {{ Str::plural('post', count($posts)) }}</div>
                        </div>
                    </div>

                    <div class="relative w-px bg-secondary shrink-0 min-h-full"></div>

                    <div class="flex-1 space-y-6">
                        @foreach($posts as $post)
                            <div class="relative">
                                <div class="absolute -left-10 top-8 w-4 h-4 rounded-full bg-white border-4 border-primary"></div>

                                <a href="{{ route('blog.show', $post->slug) }}" class="block bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md hover:border-gray-300 transition-all">
                                    <div class="flex items-start justify-between gap-4 mb-2">
                                        <h3 class="text-xl font-heading text-gray-900">{{ $post->title }}</h3>
                                        <time class="text-sm text-gray-500 whitespace-nowrap">{{ $post->published_at->format('M j') }}</time>
                                    </div>

                                    <p class="text-gray-600 leading-relaxed font-text">{{ $post->preview }}</p>

{{--                                    @if($post->tags->isNotEmpty())--}}
{{--                                        <div class="flex gap-2 mt-4">--}}
{{--                                            @foreach($post->tags as $tag)--}}
{{--                                                <span class="text-xs px-2 py-1 bg-gray-100 text-gray-700 rounded">{{ $tag->name }}</span>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>

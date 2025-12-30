<section {{ $attributes->merge(['class' => 'mb-6']) }}>
    @isset($title)<h2 class="text-3xl">{{ $title }}</h2>@endisset
    {{ $slot }}
</section>

<section {{ $attributes->merge(['class' => 'mb-10']) }}>
    @isset($title)<h2 class="mb-3">{{ $title }}</h2>@endisset
    {{ $slot }}
</section>

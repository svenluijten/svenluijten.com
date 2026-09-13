{{--
    The site's single horizontal measure. Header, content, and footer all use it
    so they can't drift out of alignment. Elements that should be wider than the
    prose measure break out with negative margins.
--}}
<div {{ $attributes->merge(['class' => 'mx-auto w-full max-w-measure px-6']) }}>
    {{ $slot }}
</div>

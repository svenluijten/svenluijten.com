{{--
    The site's single horizontal measure. Header, content, and footer all use it
    so they can't drift out of alignment: its inner edges are the paper sheet's
    edges, and the sheet's inset brings text in to the prose column.
--}}
<div {{ $attributes->merge(['class' => 'mx-auto w-full max-w-page px-6']) }}>
    {{ $slot }}
</div>

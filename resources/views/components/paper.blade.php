{{--
    An off-white sheet with two more peeking out below it (see .paper-stack in
    app.css). The layout wraps most pages in a single one; pages that mix paper
    with content straight on the cream use one per section instead.
--}}
<div {{ $attributes->merge(['class' => 'paper-stack']) }}>
    {{-- Trimmed so the sheet's padding alone sets the space at its top and bottom. --}}
    <div class="paper [&>:first-child]:mt-0 [&>:last-child]:mb-0">
        {{ $slot }}
    </div>
</div>

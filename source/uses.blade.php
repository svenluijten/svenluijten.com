@extends('_layouts.main')

@section('title', 'Uses')

@section('content')
    <header class="text-center my-2">
        <picture>
            <img src="https://picsum.photos/640/144" alt="..." class="w-full h-36 mb-4" loading="lazy">
        </picture>

        <h1 class="text-3xl font-bold mb-4">What I use</h1>
        <p>
            Check out <a class="link" href="https://uses.tech/" target="_blank">uses.tech</a> for a list of other awesome
            <code class="inline">/uses</code> pages.
        </p>
    </header>

    <x-separator color="indigo-700" />

    <main class="prose lg:prose-xl dark:prose-invert">
        <h2>Hardware</h2>
        <p>
            I'm all-in on the Apple ecosystem, as will soon become clear on this page. My daily driver phone is the
            <strong>iPhone 15 Pro Max</strong> in a <strong>Peak Design Everyday Case with Loop (Midnight)</strong>, and
            on my wrist is an <strong>Apple Watch Series 6</strong>.
        </p>

        <p>
            My default headphones when out and about are the <strong>AirPods Pro</strong> (2nd generation, USB-C), but
            I'll reach for my <strong>Sony WH1000 XM3's</strong> if I need better noise-cancelling. My home setup has a
            pair of beaten-down <strong>Audio Technica ATH M50x's</strong>, and they're still great after all these years!
            Together with my <strong>Blue Snowball</strong> microphone they make a decent audio setup for a small home
            office.
        </p>

        <p>
            Speaking of home office; the headphones and microphone are hooked up to a <strong>CalDigit TS3+</strong> dock
            which connects them back to my laptop, a <strong>MacBook Pro 2019</strong> with an i7 processor and 32 GB of
            RAM. This is hooked up (again, via the CalDigit dock) to 2 <strong>Dell UltraSharp U2515H</strong> monitors.
        </p>

        <p>
            The peripherals on and around my desk are the <strong>Logitech C920</strong> webcam, a
            <strong>Logitech MX Master 3 for Mac</strong> mouse, and the <strong>Keychron K8 Pro</strong> keyboard.
            Clickety-clack.
        </p>

        <h2>Home audio</h2>
        <p>
            I have an <strong>Audio Technica AT-LP120XUSB</strong> turntable going into a <strong>Denon PMA-600NE</strong>
            amplifier. This powers my 2 <strong>Jamo S803</strong> bookshelf speakers for listening to my vinyl record
            collection.
        </p>

        <h2>Photography</h2>
        <p>
            The main camera I shoot with is my <strong>Sony A7iv</strong>, paired with the <strong>Sony 24-70mm f/2.8 GM II</strong>
            and <strong>Sony 20mm f/1.8 G</strong> lenses. I have a <strong>Sony A6300</strong> as a secondary camera,
            for which I have the <strong>Sony 18-105mm f/4 G</strong>, <strong>Sony 55-210mm f/4.5-6.3</strong>, and
            <strong>Sigma 30mm f/1.4 DC DN</strong>.
        </p>

        <p>
            I have several accessories from Peak Design for my camera, namely the <strong>Cuff</strong>, <strong>Slide Lite</strong>,
            <strong>Slide</strong>, and of course the <strong>Capture</strong>, together with about a dozen anchor links
            strewn around the place. Their <strong>aluminium Travel Tripod</strong> also gets some occasional use.
        </p>

        <h2>Software</h2>
        <p>
            My main IDE is <strong>PhpStorm</strong>, but I'm eager to learn more about <strong>vim</strong>. My terminal
            is <strong>iTerm</strong> in the <strong>zsh</strong> shell with <strong>oh-my-zsh</strong> installed.
            <strong>Raycast</strong> is probably my most-used app out of anything on this page. I use it as a launcher,
            snippet manager, clipboard history, and more.
        </p>

        <p>
            My browser of choice is <strong>Safari</strong>, and I tend to stick close to the
            <a href="/posts/default-apps-2023" class="link">defaults</a>. I suck at remembering things, so I offload a
            lot of that work to <strong>Things</strong> for to-do's and <strong>Obsidian</strong> for my other writing
            and longer or more complex projects.
        </p>

        <h2>Travel</h2>
        <p>
            My daily carry is a <strong>20L Peak Design Everyday Backpack</strong>, the "Tan" colored version 1. This is
            fine for my daily commute and other small trips, but I also have a
            <strong>30L Peak Design Everyday Backpack</strong> ("Charcoal", also v1) for weekend trips or when I just
            need more space.
        </p>

        <p>
            My <strong>Peak Design Travel Backpack</strong> (black) serves me well on longer trips, and it will be filled
            mostly with Peak Design accessories; namely the <strong>Tech Pouch</strong>, <strong>Wash Pouch</strong>,
            <strong>Field Pouch</strong>, <strong>Camera Cube</strong>, and <strong>Packing Cubes</strong>.
        </p>
    </main>
@endsection

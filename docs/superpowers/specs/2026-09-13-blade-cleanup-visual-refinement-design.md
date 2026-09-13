# Blade Cleanup & Visual Refinement — Design

**Date:** 2026-09-13
**Status:** Approved, pending implementation plan

## Goal

Remove duplication from the Blade templates and make svenluijten.com look deliberate
rather than accidental. The existing color scheme stays: `--color-primary` (#627254),
`--color-primary-light` (#76885b), `--color-secondary` (#eca013), and
`--color-tertiary` (#faf1dd) keep their current values.

## Scope

A polish pass. Every page keeps its current layout and structure. The work is in
typography, spacing, neutrals, shared tokens, and component extraction — not in
rethinking page designs.

Explicitly out of scope:

- Dark mode. The unused `@custom-variant dark` declaration in `app.css:10` is removed;
  a cream/olive/amber palette needs its own dark counterpart designed from scratch,
  which is a separate project.
- Unifying `/blog` and `/articles` into one content-index treatment. They stay
  structurally distinct (timeline-with-cards vs. compact list) and are reconciled only
  through shared type, spacing, and card styling.
- Any refactoring outside `resources/views/` and `resources/css/app.css`.

## Part 1 — Foundation (`resources/css/app.css`)

### Type scale

Headings currently use raw Tailwind defaults (`h1` is `text-5xl`, i.e. 3rem at
leading-1, default tracking). Archivo Narrow is a condensed face and needs tightening
at display sizes. Define an explicit scale in `@theme`:

- `h1` — `clamp(2.25rem, 1.8rem + 2vw, 3rem)`, line-height `1.05`, tracking `-0.015em`
- `h2`–`h6` — step down on a consistent ratio, `leading-tight`

Prose body stays Inter at 18px, but gains `leading-relaxed`. Paragraph spacing in
`#post-content` goes from `my-2` (8px) to approximately `1em`. At 18px type, 8px
between paragraphs reads as an undifferentiated wall of text, and this is a
significant contributor to the current unrefined feeling.

### Measure

`lg:w-2/3` is a percentage, so prose runs roughly 110 characters per line on a 1440px
display. Comfortable reading is 60–75.

Cap prose at `max-w-[68ch]`. Wide elements — the concert card grid and the image
carousel — deliberately break out of that cap so the page does not read as uniformly
cramped. The `.image-carousel-wrapper` already uses `md:-mx-16` for this purpose and
its breakout must be re-derived against the new narrower measure rather than left at
the current fixed value.

This is the highest-impact single change in the pass and visibly narrows post pages on
desktop.

### Neutrals

Borders default to `--color-gray-200` (#e5e7eb) and muted text to `gray-500` — both
cool grays against warm cream (#faf1dd). Replace them with warm equivalents tinted
toward the cream and olive family. Card shadows change from black-based to
olive-tinted, so cards sit on the cream rather than floating above it.

The brand colors themselves do not change. This affects only the supporting neutrals.

### Tokens

- **Radii:** one scale replacing today's mix of `rounded`, `rounded-lg`, `rounded-xl`,
  and `rounded-2xl`. Cards `0.5rem`; inline code `0.25rem`.
- **Shadow:** a single olive-tinted card shadow token replacing the ad-hoc
  `shadow-sm` / `shadow-md` / `shadow-lg` usage.
- **Spacing:** a consistent rhythm replacing ad-hoc `mb-4` / `mb-6` / `my-8` /
  `space-y-12`.
- **Focus:** `:focus-visible` rings in `--color-secondary` with offset. The site
  currently has no focus styles at all, so keyboard navigation is invisible.

### Fonts

The `@import` at `app.css:1` loads four families: Archivo Narrow, Epilogue, Inter, and
Manrope. Epilogue is referenced only as a stray entry inside the `--font-system` stack
and is never actually applied. Remove it from the import and from the stack.

Prose images in `#post-content` currently use `rounded-xl border-8 border-white
shadow-lg`. The 8px white border is heavy; reduce to a subtler treatment with a radius
matching the card token.

## Part 2 — Component extraction

Four components. Each has one clear job and a small interface.

### `<x-post>`

`articles/show.blade.php`, `concerts/show.blade.php`, and `blog-posts/show.blade.php`
are currently identical apart from the model and a single word in the RSS footer blurb.

Interface: `:title`, `:published-at`, `feed` (the feed name, used to build the
subscribe link and blurb wording), and the default slot for rendered content.

```blade
<x-post :title="$article->title" :published-at="$article->published_at" feed="articles">
    {!! $article->rendered_content !!}
</x-post>
```

The component owns the header, the prose container, the horizontal rules, the RSS
footer, and the `<image-carousel>` / `<image-lightbox>` elements. Each show page keeps
its own `<x-slot:meta>` block, because the canonical-URL logic in
`articles/show.blade.php:3-5` is specific to that page.

### `<x-concert-card>`

The grayscale-thumbnail card, currently duplicated between `index.blade.php:35-45` and
`concerts/index.blade.php:17-27`. Takes a `:concert`.

The grayscale-to-color hover transition is intentional and is preserved.

### `<x-content-row>`

The title-left / date-right list row, currently duplicated three times: twice in
`index.blade.php` (articles and blog sections) and once in `articles/index.blade.php`.

### `<x-container>`

The `mx-auto w-full px-6 lg:w-2/3` measure, currently hand-copied into
`components/layout.blade.php:38`, `components/header.blade.php:6`, and
`components/footer.blade.php:3`. A single definition prevents the header, body, and
footer from drifting out of alignment.

### Deliberately not extracted

The "→ See all …" link appears three times in `index.blade.php` but is three lines of
markup and reads clearly inline. Extracting it would cost more in indirection than it
saves in duplication.

## Part 3 — Per-page corrections

Defects to fix during the pass:

1. `blog-posts/show.blade.php:1` passes `description=""`. Every blog post ships an
   empty meta description and a blank Open Graph card. Wire it to the post preview.
2. Concert card titles are `<h2>` nested inside sections that already have an `<h2>`.
   On `/concerts`, the year heading and the card title are both `<h2>`. Demote card
   titles to `<h3>` so the document outline is correct.
3. `footer.blade.php:1` uses `font-sans`, which resolves to Tailwind's default stack
   rather than the Manrope `--font-system`. The footer currently renders in a different
   typeface than the header. Change to `font-system`.
4. Delete the commented-out tags block at `blog-posts/index.blade.php:33-39`.
5. `components/section.blade.php:2` hardcodes `class="text-3xl"` on its `<h2>`,
   duplicating the base heading style. Remove so the new scale applies.
6. `feeds/index.blade.php:10` applies `inline-block overflow-x-scroll` to the `<table>`
   element itself, which does not produce a scrollable table. Move the overflow to a
   wrapping element.
7. Remove the `border-8 border-primary` mobile page frame from
   `components/layout.blade.php:33`.
8. Remove the amber top bar and its `hover:animate-pulse` from
   `components/header.blade.php:2`.
9. Restyle the post RSS footer from `border-2 border-primary border-dotted rounded-2xl`
   to match the new card treatment. This lives in `<x-post>` after extraction.
10. `blog-posts/show.blade.php:3` advertises the feed as `/feeds/blog.xml`. The feed is
    actually generated as `blog-posts.xml` (`app/Console/Commands/GenerateFeeds.php:66`),
    and every other reference in the codebase uses `blog-posts.xml`. Since
    `Feeds\Show` aborts with a 404 for any file it cannot find in `storage/feeds`, every
    blog post page currently points feed readers at a dead URL. Correct it to
    `blog-posts.xml`.

    This also constrains the `<x-post>` interface: the `feed` attribute must carry the
    real feed filename, so the correct values are `articles`, `concerts`, and
    `blog-posts` — not the content type names.

## Verification

The project has no meaningful test coverage — `tests/Feature/ExampleTest.php` is the
only test. Verification is therefore render-based and visual:

1. Every route in `routes/web.php` must render without error: `/`, `/contact`,
   `/explore`, `/feeds`, `/articles`, `/articles/{article}`, `/posts/{article}`,
   `/concerts`, `/concerts/{date}/{concert}`, `/blog`, `/blog/{blogPost}`, `/archive`.
2. Capture screenshots of each page before the change and after, at mobile and desktop
   widths, and compare.
3. Confirm the extracted components produce markup equivalent to what they replace,
   aside from the intended design changes.
4. Confirm `vite build` succeeds and no Tailwind class referenced in the templates has
   been left dangling by the token changes.
5. Confirm keyboard focus is visible on every interactive element.

## Decisions made during design

| Question | Decision |
|---|---|
| Ambition level | Polish pass — keep all existing layouts |
| Mobile olive page frame | Remove |
| Amber top bar with pulse | Remove |
| Grayscale concert thumbnails | Keep |
| Dotted RSS footer box | Restyle to match new card treatment |
| Dark mode | Out of scope; remove the unused variant declaration |
| Structural approach | Hybrid — four components plus a design-token layer |
| Prose measure | Cap at 68ch |
| Neutral grays | Warm them; brand colors unchanged |
| `/blog` vs `/articles` layouts | Stay structurally distinct |

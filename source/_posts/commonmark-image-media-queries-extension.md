---
title: Adding media queries to images rendered with Markdown
date: 2023-08-01
excerpt: Ever wanted more control over images in your Markdown rendered by CommonMark?
extends: _layouts.post
section: body
---

Have you ever wanted to add media queries (like `prefers-color-scheme`, `min-width`, or `orientation`) to your 
Markdown-rendered images? Unfortunately, Markdown is fairly basic in that it only renders `<img>` elements instead of
the more versatile [`<picture>` element](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/picture). You could
write HTML directly in your Markdown:

```markdown
## We're in Markdown here!
Check out this settings dialog:

<picture>
    <source srcset="/images/dark.jpg" media="(prefers-color-scheme: dark)" />
    <img src="/images/light.jpg" alt="Settings dialog" />
</picture>

## Caveats
This assumes rendering your own `<picture>`, `<source>`, and `<img>` elements is allowed by your renderer.
```

But I find this suboptimal as it takes me out of the "writing"-flow, and makes me think like a developer again. That's
why I created the [CommonMark](https://commonmark.thephpleague.com) extension 
[`sven/commonmark-image-media-queries`](https://github.com/svenluijten/commonmark-image-media-queries). With it, you can
write the following Markdown, and it'll render just the same as the example above:

```markdown
## We're in Markdown here!
Check out this settings dialog:

![dark](/images/dark.jpg){media="(prefers-color-scheme: dark)"}
![Settings dialog](/images/light.jpg)

## Caveats
None!
```

You can even simplify it further by making use of (or writing your own) shorthands. Doing this, you can replace the 
clunky `{media="(prefers-color-scheme: dark)"}` with `{scheme=dark}`.

If you're using CommonMark to render Markdown, check out this extension and see if it's a good fit for you. To see how
the extension works in-depth, visit [the GitHub repository](https://github.com/svenluijten/commonmark-image-media-queries).

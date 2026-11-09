@props([
    'title',
])

{{--
    Opens a pre-filled draft in the reader's own mail client, so replying to a post
    costs one gesture and needs no accounts or moderation. The address is split
    across two attributes and joined in JS, the way the contact page avoids printing
    it whole; the `action` is the no-JS fallback, which loses the subject but still
    opens a draft.
--}}
<post-reply>
    <form
        action="mailto:website@svenluijten.com"
        method="post"
        enctype="text/plain"
        data-reply-user="website"
        data-reply-domain="svenluijten.com"
        data-reply-subject="Reply: {{ $title }}"
        class="flex flex-col | sm:flex-row"
    >
        <input
            type="text"
            name="message"
            placeholder="Your thoughts on this..."
            aria-label="Your thoughts on this..."
            required
            {{-- Lifted on focus so the outline isn't clipped by the button's border. --}}
            class="min-w-0 flex-1 rounded-t-card border border-line bg-surface px-3 py-2 font-system text-sm placeholder:text-ink-muted focus:relative focus:z-10 | sm:rounded-l-card sm:rounded-tr-none"
        >

        <button
            type="submit"
            class="rounded-b-card border border-t-0 border-line bg-surface px-4 py-2 font-system text-sm font-semibold transition-colors hover:border-secondary hover:bg-secondary hover:text-ink | sm:rounded-r-card sm:rounded-bl-none sm:border-t sm:border-l-0"
        >
            Send
        </button>
    </form>
</post-reply>

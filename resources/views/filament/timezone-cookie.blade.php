<script>
    (() => {
        const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        const readCookie = () => document.cookie
            .split('; ')
            .find((cookie) => cookie.startsWith('timezone='))
            ?.split('=')[1];

        if (! timezone || decodeURIComponent(readCookie() ?? '') === timezone) {
            return;
        }

        document.cookie = `timezone=${encodeURIComponent(timezone)}; path=/; max-age=31536000; SameSite=Lax`;

        // Reload so the server renders dates in the detected timezone, but only if
        // the cookie actually stuck to avoid reloading forever with cookies disabled.
        if (decodeURIComponent(readCookie() ?? '') === timezone) {
            window.location.reload();
        }
    })();
</script>

<x-layout title="Feeds" description="A list of RSS feeds this website publishes.">
    <x-section title="Feeds">
        <p class="mb-4">
            Here's a list of feeds this website publishes. The right feed(s) should automatically be picked up by your
            reader. For instance, if you want to subscribe to only the <code class="code">articles</code> feed, you can
            point your reader to <a href="{{ route('articles.index') }}" class="link">the articles page</a>, and it'll
            subscribe to the feed at <code class="code">/feeds/articles.xml</code>.
        </p>

        <table class="table-auto w-full border-collapse mb-4 bg-white border border-gray-200 rounded-lg inline-block overflow-x-scroll">
            <thead>
                <tr class="border-b-2 border-black">
                    <th class="text-left py-3 px-4 align-text-top">Feed</th>
                    <th class="text-left py-3 px-4 align-text-top">Type</th>
                    <th class="text-left py-3 px-4 align-text-top">Description</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="py-3 px-4 align-text-top">
                        <a href="{{ url('feeds/all.xml') }}" class="link">
                            <code class="code">/feeds/all.xml</code>
                        </a>
                    </td>
                    <td class="py-3 px-4 align-text-top">Atom</td>
                    <td class="py-3 px-4 align-text-top">All the content published on this site, sorted by publish date, latest first.</td>
                </tr>

                <tr>
                    <td class="py-3 px-4 align-text-top">
                        <a href="{{ url('feeds/articles.xml') }}" class="link">
                            <code class="code">/feeds/articles.xml</code>
                        </a>
                    </td>
                    <td class="py-3 px-4 align-text-top">Atom</td>
                    <td class="py-3 px-4 align-text-top">All the long(er) form articles published on this site. Sorted by publish date, latest first.</td>
                </tr>

                <tr>
                    <td class="py-3 px-4 align-text-top">
                        <a href="{{ url('feeds/concerts.xml') }}" class="link">
                            <code class="code">/feeds/concerts.xml</code>
                        </a>
                    </td>
                    <td class="py-3 px-4 align-text-top">Atom</td>
                    <td class="py-3 px-4 align-text-top">All my concerts. Sorted by concert date, latest first.</td>
                </tr>

            <tr>
                <td class="py-3 px-4 align-text-top">
                    <a href="{{ url('feeds/blog-posts.xml') }}" class="link">
                        <code class="code">/feeds/blog-posts.xml</code>
                    </a>
                </td>
                <td class="py-3 px-4 align-text-top">Atom</td>
                <td class="py-3 px-4 align-text-top">All my blog posts. Sorted by publish date, latest first.</td>
            </tr>
            </tbody>
        </table>

        <p>These feeds are static files that are regenerated and updated every hour.</p>
    </x-section>
</x-layout>

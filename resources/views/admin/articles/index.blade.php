<div>
    <form action="{{ route('admin.articles') }}" method="post">
        {{ csrf_field() }}

        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title">
        </div>

        <div>
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug">
        </div>

        <div>
            <label for="published">Published (UTC)</label>
            <input type="datetime-local" name="published" id="published">
        </div>

        <div>
            <label for="content">Content (Markdown)</label><br>
            <textarea name="content" id="content" cols="30" rows="10"></textarea>
        </div>

        <button type="submit">Post</button>
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error  }}</li>
            @endforeach
        </ul>
    @endif

    <hr>
</div>

<div>
    <ul>
        @foreach ($articles as $article)
            <li>
                {{ $article->id }} - <a href="{{ route('admin.articles.update', $article) }}">{{ $article->title }}</a> ({{ $article->published_at->format('Y-m-d H:i:s') }})
            </li>
        @endforeach
    </ul>
</div>

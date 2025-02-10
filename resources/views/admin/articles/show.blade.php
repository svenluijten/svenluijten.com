<div>
    <form action="{{ route('admin.articles.update', $article) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('put') }}

        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $article->title }}">
        </div>

        <div>
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ $article->slug }}">
        </div>

        <div>
            <label for="published">Published (UTC)</label>
            <input type="datetime-local" name="published" id="published" value="{{ $article->published_at->format('Y-m-d\TH:i') }}">
        </div>

        <div>
            <label for="content">Content (Markdown)</label><br>
            <textarea name="content" id="content" cols="30" rows="10">{{ $article->content }}</textarea>
        </div>

        <button type="submit">Update</button>
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

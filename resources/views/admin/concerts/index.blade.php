<div>
    <form action="{{ route('admin.concerts') }}" method="post">
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
            <label for="artist">Artist</label>
            <input type="text" name="artist" id="artist">
        </div>

        <div>
            <label for="tour_name">Tour name</label>
            <input type="text" name="tour_name" id="tour_name">
        </div>

        <div>
            <label for="date">Date</label>
            <input type="date" name="date" id="date">
        </div>

        <div>
            <label for="published">Published (UTC)</label>
            <input type="datetime-local" name="published" id="published">
        </div>

        <div>
            <label for="venue">Venue</label>
            <select name="venue" id="venue">
                <option value="">Select an option</option>
                @foreach ($venues as $venue)
                    <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                @endforeach
            </select>
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
        @foreach ($concerts as $concert)
            <li>
                {{ $concert->id }} - <a href="{{ route('admin.concerts.update', $concert) }}">{{ $concert->title }}</a> ({{ $concert->published_at?->format('Y-m-d H:i:s') }})
            </li>
        @endforeach
    </ul>
</div>

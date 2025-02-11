<div>
    <form action="{{ route('admin.concerts.update', $concert) }}" method="post">
        {{ method_field('put') }}
        {{ csrf_field() }}

        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $concert->title }}">
        </div>

        <div>
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ $concert->slug }}">
        </div>

        <div>
            <label for="artist">Artist</label>
            <input type="text" name="artist" id="artist" value="{{ $concert->artist }}">
        </div>

        <div>
            <label for="tour_name">Tour name</label>
            <input type="text" name="tour_name" id="tour_name" value="{{ $concert->tour_name }}">
        </div>

        <div>
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="{{ $concert->date }}">
        </div>

        <div>
            <label for="published">Published (UTC)</label>
            <input type="datetime-local" name="published" id="published" value="{{ $concert->published_at }}">
        </div>

        <div>
            <label for="venue">Venue</label>
            <select name="venue" id="venue">
                <option value="">Select an option</option>
                @foreach ($venues as $venue)
                    <option value="{{ $venue->id }}" {{ $venue->id === $concert->venue_id ? 'selected' : null }}>{{ $venue->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="content">Content (Markdown)</label><br>
            <textarea name="content" id="content" cols="30" rows="10">{{ $concert->content }}</textarea>
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

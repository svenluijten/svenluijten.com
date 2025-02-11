<?php

namespace App\Http\Controllers\Admin;

use App\Events\ConcertCreated;
use App\Events\ConcertPublished;
use App\Http\Requests\CreateConcertRequest;
use App\Models\Concert;
use App\Models\Venue;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ConcertsController
{
    public function index(): View
    {
        $concerts = Concert::query()->latest('published_at')->get();
        $venues = Venue::query()->get();

        return view('admin.concerts.index', [
            'concerts' => $concerts,
            'venues' => $venues,
        ]);
    }

    public function store(CreateConcertRequest $request): RedirectResponse
    {
        $concert = Concert::query()->create([
            'title' => $request->string('title'),
            'content' => $request->string('content'),
            'slug' => $request->string('slug'),
            'tour_name' => $request->string('tour_name'),
            'artist' => $request->string('artist'),
            'date' => $request->date('date'),
            'venue_id' => $request->string('venue'),
            'published_at' => $published = $request->date('published_at'),
        ]);

        event(new ConcertCreated($concert));

        if ($published->lte(now())) {
            event(new ConcertPublished($concert));
        }

        return redirect()->route('admin.concerts');
    }

    public function show(Concert $concert): View
    {
        $venues = Venue::query()->get();

        return view('admin.concerts.show', ['concert' => $concert, 'venues' => $venues]);
    }
}

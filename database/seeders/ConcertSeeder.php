<?php

namespace Database\Seeders;

use App\Models\Concert;
use Database\Factories\ArtistFactory;
use Database\Factories\ConcertFactory;
use Database\Factories\VenueFactory;
use Illuminate\Database\Seeder;

class ConcertSeeder extends Seeder
{
    public function run(): void
    {
        $venues = VenueFactory::new()->count(10)->create();
        $artists = ArtistFactory::new()->count(25)->create();

        ConcertFactory::new()
            ->count(40)
            ->recycle($venues)
            ->create()
            ->each(function (Concert $concert) use ($artists) {
                $picked = $artists->random(rand(1, 3));

                $concert->artists()->attach($picked->shift(), ['position' => 'main']);
                $concert->artists()->attach($picked, ['position' => 'support']);
            });
    }
}

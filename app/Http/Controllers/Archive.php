<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Archive
{
    public function __invoke(): View
    {
        $items = DB::query()
            ->fromSub(function (Builder $query) {
                $query->from('articles')
                    ->select(
                        'title',
                        'slug',
                        DB::raw('published_at::timestamptz AS published_at'),
                        DB::raw('NULL::date AS date'),
                        DB::raw("'article' AS type")
                    )
                    ->unionAll(
                        DB::table('concerts')->select(
                            'title',
                            'slug',
                            DB::raw('published_at::timestamptz AS published_at'),
                            'date',
                            DB::raw("'concert' AS type")
                        )
                    );
            }, 'i')
            ->select('*', DB::raw("date_part('year', published_at)::int AS year"))
            ->orderBy('published_at', 'desc')
            ->get()
            ->groupBy('year');

        /**
         * @param  object{slug: string, type: string, published_at: string, date: ?string}  $item
         * @return string
         */
        $url = function (object $item) {
            return match ($item->type) {
                'article' => route('articles.show', $item->slug),
                'concert' => route('concerts.show', ['date' => $item->date, 'concert' => $item->slug]),
                default => throw new \InvalidArgumentException('Could not generate URL for item of type '.$item->type),
            };
        };

        return view('archive', ['items' => $items, 'url' => $url]);
    }
}

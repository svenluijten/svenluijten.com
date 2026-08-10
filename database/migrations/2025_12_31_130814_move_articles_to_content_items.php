<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('articles')
            ->select([
                DB::raw('articles.id as article_id'),
                'title',
                'slug',
                'content',
                'published_at',
                'identifier',
                DB::raw('feed_data.id as feed_data_id'),
            ])
            ->join('feed_data', function (JoinClause $join) {
                $join->on('articles.id', 'feed_data.feedable_id')
                    ->where('feedable_type', 'article');
            })
            ->orderBy('article_id')
            ->each(function ($article) {
                DB::table('content_items')->insert([
                    'ulid' => $ulid = Str::ulid(),
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'content' => $article->content,
                    'contentable_type' => 'article',
                    'contentable_id' => $article->article_id,
                    'published_at' => $article->published_at,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $id = DB::table('content_items')
                    ->where('ulid', $ulid)
                    ->value('id');

                DB::table('feed_data')
                    ->where('id', $article->feed_data_id)
                    ->update(['content_item_id' => $id]);
            });
    }

    public function down(): void
    {
        DB::table('content_items')->delete();
        DB::table('feed_data')->update(['content_item_id' => null]);
    }
};

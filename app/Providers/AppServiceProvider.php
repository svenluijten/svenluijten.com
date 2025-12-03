<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Concert;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Relation::enforceMorphMap([
            'article' => Article::class,
            'concert' => Concert::class,
        ]);
    }
}

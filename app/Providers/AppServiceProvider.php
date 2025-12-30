<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\BlogPost;
use App\Models\Concert;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\ConverterInterface;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\MarkdownConverter;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ConverterInterface::class, function () {
            $environment = new Environment([]);
            $environment->addExtension(new CommonMarkCoreExtension);
            $environment->addExtension(new FrontMatterExtension);

            return new MarkdownConverter($environment);
        });
    }

    public function boot(): void
    {
        Relation::enforceMorphMap([
            'article' => Article::class,
            'concert' => Concert::class,
            'blog-post' => BlogPost::class,
        ]);
    }
}

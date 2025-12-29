<?php

namespace App\Providers;

use App\Support\CommonMark\ExternalLinkExtension;
use App\Support\CommonMark\InternalLinkExtension;
use App\Support\Markdown\CachedMarkdownRenderer;
use App\Support\Markdown\MarkdownRenderer;
use App\Support\Markdown\Renderer;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use Phiki\Adapters\CommonMark\PhikiExtension;
use Phiki\Theme\Theme;

class MarkdownServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MarkdownConverter::class, function () {
            $environment = new Environment([
                'html_input' => 'allow',
                'allow_unsafe_links' => false,
            ]);

            $environment->addExtension(new CommonMarkCoreExtension);
            $environment->addExtension(new PhikiExtension(Theme::GithubLight, withGutter: true));
            $environment->addExtension(new InternalLinkExtension);
            $environment->addExtension(new ExternalLinkExtension);

            return new MarkdownConverter($environment);
        });

        $this->app->bind(Renderer::class, function () {
            return new CachedMarkdownRenderer($this->app->make(MarkdownRenderer::class));
        });
    }
}

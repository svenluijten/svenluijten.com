<?php

namespace App\Support\CommonMark;

use App\Models\Article;
use App\Models\Concert;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\ExtensionInterface;

class InternalLinkExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addEventListener(
            DocumentParsedEvent::class,
            [$this, 'processInternalLinks']
        );
    }

    public function processInternalLinks(DocumentParsedEvent $event): void
    {
        $document = $event->getDocument();

        foreach ($document->iterator() as $node) {
            if (! $node instanceof Link) {
                continue;
            }

            $url = $node->getUrl();

            if (preg_match('/^(article|concert):([A-Z0-9]+)$/i', $url, $matches)) {
                [$_, $type, $ulid] = $matches;

                $resolvedUrl = $this->resolveInternalLink($type, $ulid);
                $node->setUrl($resolvedUrl);
            }
        }
    }

    protected function resolveInternalLink(string $type, string $ulid): string
    {
        $model = match ($type) {
            'article' => Article::query()->where('ulid', $ulid)->first(),
            'concert' => Concert::query()->where('ulid', $ulid)->first(),
            default => null,
        };

        if ($model === null) {
            return '#';
        }

        return match ($type) {
            'article' => route('posts.show', $model),
            'concert' => $model->url,
            default => '#',
        };
    }
}

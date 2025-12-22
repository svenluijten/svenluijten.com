<?php

namespace App\Support\CommonMark;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\ExtensionInterface;

class ExternalLinkExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addEventListener(
            DocumentParsedEvent::class,
            [$this, 'processExternalLinks']
        );
    }

    public function processExternalLinks(DocumentParsedEvent $event): void
    {
        $document = $event->getDocument();

        foreach ($document->iterator() as $node) {
            if (! $node instanceof Link) {
                continue;
            }

            $url = $node->getUrl();

            if (preg_match('/^(article|concert):/i', $url)) {
                continue;
            }

            if (str_starts_with($url, '#') || str_starts_with($url, '/')) {
                continue;
            }

            if ($this->isExternalUrl($url)) {
                $node->data->set('attributes/target', '_blank');
                $node->data->set('attributes/rel', 'noopener noreferrer');
            }
        }
    }

    protected function isExternalUrl(string $url): bool
    {
        $parsedUrl = parse_url($url);

        if (! isset($parsedUrl['host'])) {
            return false;
        }

        $appUrl = config('app.url');
        $appHost = parse_url($appUrl, PHP_URL_HOST);

        return $parsedUrl['host'] !== $appHost;
    }
}

<?php

namespace App\Actions;

use App\Makeable;
use App\ParsedFile;
use League\CommonMark\ConverterInterface;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use Symfony\Component\Finder\SplFileInfo;

readonly class ConvertToParsedFile
{
    use Makeable;

    public function __construct(private ConverterInterface $converter) {}

    public function execute(SplFileInfo $file): ParsedFile
    {
        $rawContents = $file->getContents();
        $parsedContents = $this->converter->convert($rawContents);

        if (! $parsedContents instanceof RenderedContentWithFrontMatter) {
            throw new \InvalidArgumentException(
                'Could not read Frontmatter from file "'.$file->getRelativePathname().'"'
            );
        }

        $markdown = preg_replace('/^---\n.*?\n---\n/s', '', $rawContents);

        return new ParsedFile(
            markdown: trim($markdown),
            frontmatter: $parsedContents->getFrontMatter(),
            original: $file,
        );
    }
}

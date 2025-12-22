<?php

namespace App;

use Symfony\Component\Finder\SplFileInfo;

readonly class ParsedFile
{
    public function __construct(
        public string $markdown,
        public array $frontmatter,
        public SplFileInfo $original,
    ) {}

    public function property(string $key, mixed $default = null): string
    {
        return $this->frontmatter[$key] ?? $default;
    }
}

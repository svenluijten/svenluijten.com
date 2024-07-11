<?php

namespace App\Exceptions;

use RuntimeException;
use TightenCo\Jigsaw\PageVariable;

class BuildException extends RuntimeException
{
    public static function missingFrontmatterProperty(string $property, PageVariable $page): self
    {
        $message = sprintf('Missing "%s" frontmatter property for "%s".', $property, $page->getPath());

        return new self($message);
    }
}

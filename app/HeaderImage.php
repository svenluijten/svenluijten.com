<?php

namespace App;

use App\Exceptions\BuildException;
use TightenCo\Jigsaw\PageVariable;

final readonly class HeaderImage
{
    public function __construct(
        private PageVariable $page,
        private string $folder = '/assets/images/headers',
    ) {
    }

    public function source(): string
    {
        $image = $this->page->header_image ?: $this->page->getFilename();

        return $this->folder . '/' . $image . '.jpg';
    }

    public function alt(): string
    {
        if ($this->page->get() === null) {
            throw BuildException::missingFrontmatterProperty('header_image_alt', $this->page);
        }

        return $this->page->header_image_alt ?: 'Alt text';
    }
}

<?php

namespace App\Support\Markdown;

use App\Makeable;

class StripMarkdown
{
    use Makeable;

    public function execute(string $markdown): string
    {
        // Remove images: ![alt](url)
        $text = preg_replace('/!\[([^]]*)]\([^)]+\)/', '', $markdown);

        // Remove links but keep text: [text](url) -> text
        $text = preg_replace('/\[([^]]+)]\([^)]+\)/', '$1', $text);

        // Remove bold/italic: **text**, *text*, __text__, _text_
        $text = preg_replace('/(\*\*|__)(.*?)\1/', '$2', $text);
        $text = preg_replace('/([*_])(.*?)/', '$2', $text);

        // Remove headers: # Header
        $text = preg_replace('/^#{1,6}(\s)+/m', '$1', $text);

        // Remove list markers: -, *, +, 1.
        $text = preg_replace('/^\s*[-*+]\s+/m', '', $text);
        $text = preg_replace('/^\s*\d+\.\s+/m', '', $text);

        // Remove code blocks: ```code```
        $text = preg_replace('/```[^`]*```/s', '', $text);

        // Remove inline code: `code`
        $text = preg_replace('/`([^`]+)`/', '$1', $text);

        // Clean up: remove empty lines, trim, collapse multiple spaces
        $text = preg_replace('/\n{2,}/', ' ', $text);
        $text = preg_replace('/\s+/', ' ', $text);

        return trim($text);
    }
}

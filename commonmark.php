<?php

use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\BlockQuote;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Block\ListBlock;
use League\CommonMark\Extension\DefaultAttributes\DefaultAttributesExtension;
use League\CommonMark\Extension\Footnote\FootnoteExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Node\Block\Paragraph;
use Sven\CommonMark\ImageMediaQueries\ImageMediaQueriesExtension;
use Sven\CommonMark\ImageMediaQueries\Shorthands\ColorScheme;

$imageMediaQueriesExtension = new ImageMediaQueriesExtension();
$imageMediaQueriesExtension->addShorthand(new ColorScheme());

return [
    'config' => [
        'heading_permalink' => headingPermalinkConfig(),
        'default_attributes' => defaultAttributeConfig(),
        'image_media_queries' => imageMediaQueriesConfig(),
        'footnote' => footnoteConfig(),
    ],
    'extensions' => [
        // new HeadingPermalinkExtension(),
        new AttributesExtension(),
        new DefaultAttributesExtension(),
        $imageMediaQueriesExtension,
        // new FootnoteExtension(),
    ],
];

function headingPermalinkConfig(): array
{
    return [
        'html_class' => 'md:-ml-6 mr-2',
        'id_prefix' => '',
        'fragment_prefix' => '',
        'symbol' => '#',
    ];
}

function defaultAttributeConfig(): array
{
    return [
        Heading::class => [
            'class' => static function (Heading $heading) {
                $size = match ($heading->getLevel()) {
                    2 => 'text-xl',
                    default => 'text-lg',
                };

                return [$size, 'font-bold'];
            },
        ],
        BlockQuote::class => [
            'class' => 'border-l-4 border-indigo-200, pl-4 dark:border-indigo-500',
        ],
        ListBlock::class => [
            'class' => static function (ListBlock $list) {
                return match ($list->getListData()->type) {
                    ListBlock::TYPE_ORDERED => 'list-decimal',
                    ListBlock::TYPE_BULLET => 'list-disc',
                    default => 'list-disc',
                };
            }
        ]
    ];
}

function imageMediaQueriesConfig(): array
{
    return [
        'picture_class' => '',
    ];
}

function footnoteConfig(): array
{
    return [
        'backref_class' => 'text-sm font-bold',
        'container_class' => 'footnotes',
        'container_add_hr' => true,
    ];
}

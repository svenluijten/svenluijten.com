<?php

use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\BlockQuote;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Block\ListBlock;
use League\CommonMark\Extension\DefaultAttributes\DefaultAttributesExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Node\Block\Paragraph;
use Sven\CommonMark\DarkModeImages\DarkModeImagesExtension;

return [
    'config' => [
        'heading_permalink' => headingPermalinkConfig(),
        'default_attributes' => defaultAttributeConfig(),
        'dark_mode_images' => darkModeImagesConfig(),
    ],
    'extensions' => [
        new HeadingPermalinkExtension(),
        new AttributesExtension(),
        new DefaultAttributesExtension(),
        new DarkModeImagesExtension(),
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
        Paragraph::class => [
            'class' => 'mb-4 text-xl leading-relaxed',
        ],
        Heading::class => [
            'class' => static function (Heading $heading) {
                $size = match ($heading->getLevel()) {
                    2 => 'text-2xl',
                    3 => 'text-xl',
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
                $type = match ($list->getListData()->type) {
                    ListBlock::TYPE_ORDERED => 'list-decimal',
                    ListBlock::TYPE_BULLET => 'list-disc',
                    default => 'list-disc',
                };

                return [$type, 'ml-8 mb-4'];
            }
        ]
    ];
}

function darkModeImagesConfig(): array
{
    return [
        'picture_class' => '',
        'light_image_class' => 'l',
        'dark_image_class' => 'd',
    ];
}

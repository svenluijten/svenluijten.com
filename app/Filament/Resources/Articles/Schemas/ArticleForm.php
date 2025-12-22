<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Filament\Handlers\SaveUploadedFileAttachment;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                        if (! $get('is_slug_changed_manually') && filled($state)) {
                            $set('slug', Str::slug($state));
                        }
                    })
                    ->live(onBlur: true)
                    ->required(),

                TextInput::make('slug')
                    ->afterStateUpdated(function (Set $set) {
                        $set('is_slug_changed_manually', true);
                    })
                    ->required(),

                Hidden::make('is_slug_changed_manually')
                    ->default(false)
                    ->dehydrated(false),

                MarkdownEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->saveUploadedFileAttachmentUsing((new SaveUploadedFileAttachment('article-content'))(...))
                    ->getFileAttachmentUrlUsing(function ($component, $file) {
                        return $file;
                    })
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'link',
                        'heading',
                        'blockquote',
                        'codeBlock',
                        'bulletList',
                        'orderedList',
                        'attachFiles',
                    ]),

                TextInput::make('summary')
                    ->required()
                    ->columnSpanFull(),

                DateTimePicker::make('published_at'),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Records\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RecordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Textarea::make('comment')
                    ->rows(4)
                    ->columnSpanFull(),

                TextInput::make('discogs_release_code')
                    ->label('Discogs Release Code')
                    ->placeholder('e.g., r123456')
                    ->maxLength(255),

                Select::make('artists')
                    ->relationship('artists', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('name')->required(),
                    ])
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('album_cover')
                    ->label('Album Cover')
                    ->disk('public')
                    ->collection('album-cover')
                    ->image()
                    ->maxFiles(1)
                    ->imageEditor()
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('backside')
                    ->label('Backside')
                    ->collection('backside')
                    ->image()
                    ->maxFiles(1)
                    ->imageEditor()
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('inside')
                    ->label('Inside (Gatefold)')
                    ->collection('inside')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->imageEditor()
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('vinyl_photos')
                    ->label('Vinyl Photos')
                    ->collection('vinyl-photos')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->imageEditor()
                    ->columnSpanFull(),
            ]);
    }
}

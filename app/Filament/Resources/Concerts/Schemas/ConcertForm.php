<?php

namespace App\Filament\Resources\Concerts\Schemas;

use App\Models\Venue;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ConcertForm
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

                TextInput::make('tour_name')
                    ->required(),
                DatePicker::make('date')
                    ->required(),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),

                Select::make('main_artists')
                    ->label('Artist(s)')
                    ->relationship(name: 'artists', titleAttribute: 'name')
                    ->multiple()
                    ->pivotData([
                        'position' => 'main',
                    ]),

                Select::make('support_artists')
                    ->label('Support Artist(s)')
                    ->relationship(name: 'artists', titleAttribute: 'name')
                    ->multiple()
                    ->pivotData([
                        'position' => 'support',
                    ])
                    ->createOptionForm([
                        TextInput::make('name')->required(),
                    ]),

                Select::make('venue_id')
                    ->label('Venue')
                    ->relationship('venue', 'name')
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('country')
                            ->required(),
                        TextInput::make('city')
                            ->required(),
                    ])
                    ->searchable(),

                DateTimePicker::make('published_at'),

                Hidden::make('is_slug_changed_manually')
                    ->default(false)
                    ->dehydrated(false),
            ]);
    }
}

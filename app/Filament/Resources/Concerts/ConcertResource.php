<?php

namespace App\Filament\Resources\Concerts;

use App\Filament\Resources\Concerts\Pages\CreateConcert;
use App\Filament\Resources\Concerts\Pages\EditConcert;
use App\Filament\Resources\Concerts\Pages\ListConcerts;
use App\Filament\Resources\Concerts\Schemas\ConcertForm;
use App\Filament\Resources\Concerts\Tables\ConcertsTable;
use App\Models\Concert;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ConcertResource extends Resource
{
    protected static ?string $model = Concert::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Microphone;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $recordRouteKeyName = 'ulid';

    public static function form(Schema $schema): Schema
    {
        return ConcertForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConcertsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListConcerts::route('/'),
            'create' => CreateConcert::route('/create'),
            'edit' => EditConcert::route('/{record:ulid}/edit'),
        ];
    }
}

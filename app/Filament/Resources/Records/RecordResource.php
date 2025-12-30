<?php

namespace App\Filament\Resources\Records;

use App\Filament\Resources\Records\Pages\CreateRecord;
use App\Filament\Resources\Records\Pages\EditRecord;
use App\Filament\Resources\Records\Pages\ListRecords;
use App\Filament\Resources\Records\Schemas\RecordForm;
use App\Filament\Resources\Records\Tables\RecordsTable;
use App\Models\Record;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RecordResource extends Resource
{
    protected static ?string $model = Record::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::MusicalNote;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $recordRouteKeyName = 'ulid';

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    public static function form(Schema $schema): Schema
    {
        return RecordForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RecordsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRecords::route('/'),
            'create' => CreateRecord::route('/create'),
            'edit' => EditRecord::route('/{record:ulid}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\Records\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RecordsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->orderBy('created_at', 'desc'))
            ->columns([
                SpatieMediaLibraryImageColumn::make('album_cover')
                    ->label('Cover')
                    ->collection('album-cover')
                    ->square()
                    ->width(60)
                    ->height(60),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('artists.name')
                    ->label('Artists')
                    ->badge()
                    ->searchable(),

                TextColumn::make('discogs_release_code')
                    ->label('Discogs')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

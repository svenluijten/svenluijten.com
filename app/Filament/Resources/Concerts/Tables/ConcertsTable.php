<?php

namespace App\Filament\Resources\Concerts\Tables;

use App\Models\Venue;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class ConcertsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('artist')
                    ->hidden()
                    ->searchable(),
                TextColumn::make('tour_name')
                    ->label('Tour')
                    ->hidden()
                    ->searchable(),
                TextColumn::make('slug')
                    ->hidden()
                    ->searchable(),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('venue.name'),
                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
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
                    BulkAction::make('Update venue')
                        ->schema([
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
                        ])
                        ->action(function (Collection $records, array $data) {
                            $records->each->update([
                                'venue_id' => $data['venue_id'],
                            ]);
                        })
                ]),
            ]);
    }
}

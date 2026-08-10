<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                return $query
                    ->join('content_items', function ($join) {
                        $join->on('articles.id', '=', 'content_items.contentable_id')
                            ->where('content_items.contentable_type', '=', 'article');
                    })
                    ->orderBy('content_items.published_at', 'desc')
                    ->select('articles.*');
            })
            ->columns([
                TextColumn::make('contentItem.title')
                    ->searchable(),
                TextColumn::make('contentItem.slug')
                    ->hidden()
                    ->searchable(),
                TextColumn::make('contentItem.published_at')
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
                ]),
            ]);
    }
}

<?php

namespace App\Filament\Resources\BlogPosts\Pages;

use App\Filament\Resources\BlogPosts\BlogPostResource;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;

class EditFeedBlogPost extends EditRecord
{
    protected static string $resource = BlogPostResource::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationLabel = 'Feed';

    private string $feedId;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('feed_id')
                    ->label('Feed ID')
                    ->columnSpanFull(),
            ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->feedId = $data['feed_id'];

        unset($data['feed_id']);

        return $data;
    }

    protected function afterSave(): void
    {
        $this->record->feedData()->updateOrCreate([], [
            'identifier' => $this->feedId,
        ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['feed_id'] = $this->record->feedData->identifier ?? $this->record->ulid;

        return $data;
    }
}

<?php

namespace App\Models;

use App\Models\Concerns\HasFeed;
use App\Models\Concerns\HasMarkdownContent;
use App\Models\Concerns\HasUlids;
use App\Models\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

#[ScopedBy(PublishedScope::class)]
class Article extends Model implements HasMedia
{
    use HasFeed;
    use HasMarkdownContent;
    use HasUlids;
    use InteractsWithMedia;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'published_at' => 'immutable_datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

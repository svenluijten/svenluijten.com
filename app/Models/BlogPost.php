<?php

namespace App\Models;

use App\Models\Concerns\HasFeed;
use App\Models\Concerns\HasMarkdownContent;
use App\Models\Concerns\HasMediaLibrary;
use App\Models\Concerns\HasUlids;
use App\Models\Scopes\PublishedScope;
use App\Support\Markdown\StripMarkdown;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;

#[ScopedBy(PublishedScope::class)]
class BlogPost extends Model implements HasMedia
{
    use HasFactory;
    use HasFeed;
    use HasMarkdownContent;
    use HasMediaLibrary;
    use HasUlids;

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

    public function getMediaCollection(): string
    {
        return 'blog-content';
    }

    protected function preview(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::limit(StripMarkdown::make()->execute($this->attributes['content']), 120),
        )->shouldCache();
    }
}

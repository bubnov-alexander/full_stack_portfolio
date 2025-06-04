<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use \Spatie\MediaLibrary\InteractsWithMedia;

/**
 *
 *
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social query()
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social whereUrl($value)
 * @mixin \Eloquent
 */
class Social extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'socials';

    protected $fillable = [
        'name',
        'url',
        'active'
    ];

    protected $hidden = [];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('social')->singleFile();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function IsActive(): bool
    {
        return $this->active;
    }

    public function setIsActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}

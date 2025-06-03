<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 *
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property int $is_featured
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Stack> $stacks
 * @property-read int|null $stacks_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Project extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'tech_stack',
        'is_featured',
        'order'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('project')->singleFile();
    }

    public function stacks(): BelongsToMany
    {
        return $this->belongsToMany(Stack::class, 'project_stack');
    }

    protected static function booted(): void
    {
        static::creating(function ($project) {
            // Сдвигаем все проекты, если порядок уже занят
            Project::where('order', '>=', $project->order)->increment('order');
        });

        static::updating(function ($project) {
            if ($project->isDirty('order')) {
                $oldOrder = $project->getOriginal('order');
                $newOrder = $project->order;

                if ($newOrder < $oldOrder) {
                    // Двигаем вниз те, кто между новым и старым
                    Project::where('id', '!=', $project->id)
                        ->whereBetween('order', [$newOrder, $oldOrder - 1])
                        ->increment('order');
                } elseif ($newOrder > $oldOrder) {
                    // Двигаем вверх те, кто между старым и новым
                    Project::where('id', '!=', $project->id)
                        ->whereBetween('order', [$oldOrder + 1, $newOrder])
                        ->decrement('order');
                }
            }
        });
    }

    public function getStacks(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->stacks;
    }

    public function setStacks(\Illuminate\Database\Eloquent\Collection $stacks): void
    {
        $this->stacks = $stacks;
    }

    public function getStacksCount(): ?int
    {
        return $this->stacks_count;
    }

    public function setStacksCount(?int $stacks_count): void
    {
        $this->stacks_count = $stacks_count;
    }

    public function getMediaCount(): ?int
    {
        return $this->media_count;
    }

    public function setMediaCount(?int $media_count): void
    {
        $this->media_count = $media_count;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order): void
    {
        $this->order = $order;
    }

    public function getIsFeatured(): int
    {
        return $this->is_featured;
    }

    public function setIsFeatured(int $is_featured): void
    {
        $this->is_featured = $is_featured;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}

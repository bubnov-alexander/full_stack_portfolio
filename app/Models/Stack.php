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
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stack query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stack whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stack whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stack whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Stack extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'name'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('stack')->singleFile();
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_stack');
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getMediaCount(): ?int
    {
        return $this->media_count;
    }

    public function setMediaCount(?int $media_count): void
    {
        $this->media_count = $media_count;
    }

    public function getProjects(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->projects;
    }

    public function setProjects(\Illuminate\Database\Eloquent\Collection $projects): void
    {
        $this->projects = $projects;
    }

    public function getProjectsCount(): ?int
    {
        return $this->projects_count;
    }

    public function setProjectsCount(?int $projects_count): void
    {
        $this->projects_count = $projects_count;
    }
}

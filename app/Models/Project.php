<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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
}

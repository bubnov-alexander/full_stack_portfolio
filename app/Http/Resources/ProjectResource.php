<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var $this Project*/

        return [
            'id' => $this->getKey(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'description' => $this->getDescription(),
            'is_featured' => $this->getIsFeatured(),
            'order' => $this->getOrder(),
            // Форматируем media для проекта
            'media' => $this->getMedia('project')->map(function ($media) {
                return [
                    'id' => $media->id,
                    'url' => $media->getUrl(),
                ];
            }),

            'stacks' => $this->stacks->map(function ($stack) {
                return [
                    'id' => $stack->id,
                    'title' => $stack->title,
                    'media' => $stack->getMedia('stack')->map(function ($media) {
                        return [
                            'id' => $media->id,
                            'url' => $media->getUrl(),
                        ];
                    }),
                ];
            }),
        ];
    }

}

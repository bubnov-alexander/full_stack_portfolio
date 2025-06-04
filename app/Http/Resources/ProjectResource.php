<?php

namespace App\Http\Resources;

use App\Models\Project;
use App\Models\Stack;
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
        /** @var $this Project */
        return [
            'id' => $this->getKey(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'description' => $this->getDescription(),
            'is_featured' => $this->getIsFeatured(),
            'order' => $this->getOrder(),

            'media' => $this->getMedia('project')
                ->map(function ($media) {
                    return [
                        'id' => $media->getKey(),
                        'url' => $media->getUrl(),
                    ];
                }),

            /** @var $stack Stack */

            'stacks' => $this->stacks->map(function ($stack) {
                return [
                    'id' => $stack->getKey(),
                    'name' => $stack->getName(),
                    'media' => $stack->getMedia('stack')
                        ->map(function ($media) {
                            return [
                                'id' => $media->getKey(),
                                'url' => $media->getUrl(),
                            ];
                        }),
                ];
            }),
        ];
    }

}

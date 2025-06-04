<?php

namespace App\Http\Resources;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var $this Page */

        return [
            'id' => $this->getKey(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'content' => $this->getContent(),
            'meta_title' => $this->getMetaTitle(),
            'meta_description' => $this->getMetaDescription(),
            'meta_keywords' => $this->getMetaKeywords(),
            'is_visible' => $this->getIsVisible(),
        ];
    }
}

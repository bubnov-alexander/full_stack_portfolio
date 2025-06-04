<?php

namespace App\Http\Resources;

use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var $this Social*/

        return [
            'id' => $this->getKey(),
            'name' => $this->getName(),
            'url' => $this->getUrl(),
            'active' => $this->IsActive(),

            'media' => $this->getMedia('social')->map(function ($media) {
                return [
                    'id' => $media->getKey(),
                    'url' => $media->getUrl(),
                ];
            }),
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema (
 *     schema="ImageMediaResource",
 *     @OA\Property(property="url", type="string")
 * )
 *
 * Class ImageMediaResource
 */
class ImageMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'url' => $this->resource->getUrl(),
        ];
    }
}

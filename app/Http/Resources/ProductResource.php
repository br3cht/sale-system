<?php

namespace App\Http\Resources;

use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $service = resolve(FileService::class);
        $data  = parent::toArray($request);
        $data['categoria'] = $this->category->name;
        $data['image'] = $service->getTemporaryUrl($this->image, 20);
        return parent::toArray($request);
    }
}

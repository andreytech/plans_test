<?php

namespace App\Http\Resources;

use App\Models\Feature;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResource extends JsonResource
{
    private function getResource(): Feature
    {
        return $this->resource;
    }

    public function toArray($request): array
    {
        $feature = $this->getResource();

        return [
            'name' => $feature->name,
            'is_beta' => $feature->is_beta,
        ];
    }
}

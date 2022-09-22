<?php

namespace App\Http\Resources;

use App\Models\Plan;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    private function getResource(): Plan
    {
        return $this->resource;
    }

    public function toArray($request): array
    {
        $plan = $this->getResource();

        return [
            'name' => $plan->name,
            'description' => $plan->description,
            'price' => $plan->price,
            'type_id' => $plan->type_id,
            'trial_in_days' => $plan->trial_in_days,
            'features' => FeatureResource::collection($plan->features),
        ];
    }
}

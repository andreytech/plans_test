<?php

namespace Tests\Feature;

use App\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_plan_api_returns_a_successful_response(): void
    {
        /** @var Plan $plan */
        $plan = Plan::factory()->create();

        $response = $this->getJson(route('plans.index'));
        $response->assertOk();

        $response->assertJson([
            'data' => [
                [
                    'name' => $plan->name,
                    'description' => $plan->description,
                    'price' => $plan->price,
                    'type_id' => $plan->type_id,
                    'trial_in_days' => $plan->trial_in_days,
                    'features' => [],
                ],
            ],
        ]);
    }
}

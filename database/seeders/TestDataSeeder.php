<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Hotel;
use App\Models\Lake;
use App\Models\Plan;
use App\Models\Region;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\NoReturn;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        $plans = $this->createPlans();

        $featuresLite = $this->createFeatures(
            ['name' => 'CMS integration', 'is_beta' => false],
            ['name' => 'Email & SMS reminders', 'is_beta' => false],
            ['name' => 'Customer support 24/7', 'is_beta' => false],
        );
        /** @var Plan $planLite */
        $planLite = $plans->where('type_id', Plan::TYPE_ID_DEFAULT)->first();
        $planLite->features()->sync($featuresLite);

        $featuresPro = $this->createFeatures(
            ['name' => 'Advanced analytics', 'is_beta' => false],
            ['name' => '100+ integrations', 'is_beta' => false],
            ['name' => 'Chat widget', 'is_beta' => false],
            ['name' => 'Templates libary', 'is_beta' => false],
        );
        /** @var Plan $planPopular */
        $planPopular = $plans->where('type_id', Plan::TYPE_ID_POPULAR)->first();
        $planPopular->features()->sync($featuresPro);

        $featuresUltimate = $this->createFeatures(
            ['name' => 'Daily performance reports', 'is_beta' => false],
            ['name' => 'Dedicated assistant', 'is_beta' => false],
            ['name' => 'Artifial inelligence', 'is_beta' => true],
            ['name' => 'Marketing tools & automations', 'is_beta' => false],
        );
        /** @var Plan $planRecommended */
        $planRecommended = $plans->where('type_id', Plan::TYPE_ID_RECOMMENDED)->first();
        $planRecommended->features()->sync($featuresUltimate);
    }

    private function createPlans(): Collection
    {
        return Plan::factory(3)
            ->state(new Sequence(
                [
                    'name' => 'Lite',
                    'description' => 'Perfect to get started',
                    'price' => 1100,
                    'type_id' => Plan::TYPE_ID_DEFAULT,
                    'trial_in_days' => 7,
                ],
                [
                    'name' => 'Pro',
                    'description' => 'Best of professionals',
                    'price' => 1900,
                    'type_id' => Plan::TYPE_ID_POPULAR,
                    'trial_in_days' => null,
                ],
                [
                    'name' => 'Ultimate',
                    'description' => 'Toolset for hard players',
                    'price' => 3500,
                    'type_id' => Plan::TYPE_ID_RECOMMENDED,
                    'trial_in_days' => null,
                ],
            ))
            ->create();
    }

    private function createFeatures(array ...$feature): Collection
    {
        return Feature::factory(count($feature))
            ->state(new Sequence(...$feature))
            ->create();
    }
}

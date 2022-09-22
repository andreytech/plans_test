<template>
  <div class="container">
    <table class="index__table">
      <thead class="index__head">
        <tr>
          <th class="index__head-text" colspan="3">Overview</th>
          <th v-for="(plan, key) in plans" :key="key" class="index__head-text">{{ plan.name }}</th>
        </tr>
      </thead>
      <tbody class="index__table-body">
        <tr v-for="(feature, key) in features" :key="key">
          <td colspan="3">{{ feature.name }}</td>
          <td><CheckIcon v-if="includeFeature(feature, 1)" /></td>
          <td><CheckIcon v-if="includeFeature(feature, 2)" /></td>
          <td><CheckIcon v-if="includeFeature(feature, 3)" /></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import CheckIcon from "@/layout/CheckIcon";

const props = defineProps({
  plans: Object,
  features: Object
});

const includeFeature = (feature, planType) => {
  if (planType === 3) {
    return true;
  }

  const plan1 = props.plans.filter(plan => plan.type_id === 1)[0];
  const plan2 = props.plans.filter(plan => plan.type_id === 2)[0];

  let availableFeatures = [];

  if (planType === 1) {
    availableFeatures.push(...plan1.features);
  }
  if (planType === 2) {
    availableFeatures.push(...plan1.features);
    availableFeatures.push(...plan2.features);
  }

  for (const [, planFeature] of Object.entries(availableFeatures)) {
    if (planFeature.name === feature.name) {
      return true;
    }
  }

  return false;
};
</script>
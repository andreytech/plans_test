<template>
  <div class="card" :class="props.plan.type_id === 3 ? 'unique' : ''"
  >
    <div class="card__inner">
      <p v-if="props.plan.type_id === 2" class="notify">Popular</p>
      <h2 class="card__title">
        <LightningIcon />
        {{ props.plan.name }}
      </h2>
      <p class="card__subtitle">{{ props.plan.description }}</p>

      <p class="card__price">
        <span class="card__price-val">$</span>{{ getPrice(props.plan) }}
        <span class="card__price-info">pear seat /month</span>
      </p>

      <a class="card__link" href="#">{{ buttonText(props.plan) }}</a>

      <div class="card__info">
        <h3 class="card__info-title">{{ featuresTitle(props.plan) }}</h3>

        <ul class="card__info-list">
          <li v-for="(feature, fKey) in props.plan.features" :key="fKey" class="card__info-item">
            <CheckIcon />
            <span>{{ feature.name }}</span>
            <span v-if="feature.is_beta" class="notify">beta</span>
          </li>
        </ul>
      </div>
    </div>

    <a class="card__bottom-link" href="#"> See all features </a>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import CheckIcon from "@/layout/CheckIcon";
import LightningIcon from "@/layout/LightningIcon";

const props = defineProps({
  plan: Object,
  isYearly: Boolean
});

const getPrice = plan => {
  const sale = props.isYearly ? 0.2 : 0;

  return (plan.price - (plan.price * sale)) / 100;
};

const buttonText = plan => {
  if (plan.trial_in_days) {
    return 'Try '+plan.trial_in_days+' days for free';
  }

  return 'Get started';
};

const featuresTitle = plan => {
  switch (plan.type_id) {
    case 1:
      return 'Life includes:';
    case 2:
      return 'Everything in Life, plus:';
    case 3:
      return 'Everything in Pro, plus:';
    default:
      return 'Includes:'
  }
};
</script>
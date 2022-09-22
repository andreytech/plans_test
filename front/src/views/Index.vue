<template>
  <div class="index">
    <div class="index__top">
      <div class="container">
        <div class="index__header">
          <h1 class="index__title">Ready to get started?</h1>

          <p class="index__text">Choose a plan tailored to your needs</p>

          <div class="index__control">
            <p class="notify">20% off</p>
            <label class="form-switch">
              <span class="index__control-time">Monthly</span>
              <input v-model="isYearly" type="checkbox" />
              <i></i>
              <span class="index__control-time active">Yearly</span>
            </label>
          </div>
        </div>

        <div class="index__wrapper">
          <Plan v-for="(plan, pKey) in plans" :key="pKey" :plan="plan" :is-yearly="isYearly" />
        </div>
      </div>
    </div>

    <Features :plans="plans" :features="features" />
  </div>
</template>

<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import Plan from "@/components/Plan";
import Features from "@/components/Features";

const plans = ref();
const features = ref([]);
const isYearly = ref(false);

onMounted(() => {
  axios
    .get('http://localhost/api/plans')
    .then(response => {
      plans.value = response.data.data;
      plans.value.forEach(plan => features.value.push(...plan.features));
    });
});
</script>
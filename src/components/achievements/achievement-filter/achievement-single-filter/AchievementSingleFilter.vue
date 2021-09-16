<template>
  <div class="basic-filter">
    <label :for="inputId" class="py-1">
      {{ title }}
    </label>

    <div class="single-filter">
      <input type="text" :id="inputId" :placeholder="!!placeholder ? placeholder : ''" />
      <i class="fas fa-times-circle clear-icon"></i>
    </div>

    <small v-if="!!description">
      {{ description }}
    </small>
  </div>
</template>

<script>
import {computed} from "vue";

export default {
  name: 'AchievementSingleFilter',
  props: {
    title: {
      required: true,
      type: String
    },
    description: {
      required: false,
      type: String
    },
    placeholder: {
      required: false,
      type: String
    }
  },
  setup(props) {
    const inputId = computed(() => {
      return props.title.toLowerCase().replace(' ', '-');
    });

    return { inputId }
  }
}
</script>

<style scoped lang="scss">
@import "achievement-single-filter";
</style>

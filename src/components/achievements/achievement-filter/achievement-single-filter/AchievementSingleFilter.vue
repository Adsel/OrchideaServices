<template>
  <div class="basic-filter">
    <label :for="inputId" class="py-1">
      {{ title }}
    </label>
    <div class="single-filter">
      <input type="text" v-model="inputData" :id="inputId" :placeholder="!!placeholder ? placeholder : ''"/>
      <i class="fas fa-times-circle clear-icon" @click="resetData"></i>
    </div>
    <small v-if="!!description">
      {{ description }}
    </small>
  </div>
</template>
<script>
import {computed, ref} from "vue";

export default {
  name: 'AchievementSingleFilter',
  emits: [
    'change'
  ],
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
    const inputData = ref('');

    const inputId = computed(() => {
      return props.title.toLowerCase().replace(' ', '-');
    });

    const resetData = () => {
      inputData.value = '';
    };

    const getInputValue = () => {
      return inputData.value;
    };

    return {inputData, inputId, getInputValue, resetData}
  }
}
</script>
<style scoped lang="scss">
@import "achievement-single-filter";
</style>

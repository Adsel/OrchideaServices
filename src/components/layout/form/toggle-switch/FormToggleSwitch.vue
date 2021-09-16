<template>
  <label class="switch">
    <input type="checkbox" v-model="isChecked" @change="emitChangeEvent">
    <span class="round-slider"></span>
  </label>
</template>

<script>
import {ref} from "vue";

export default {
  name: 'FormToggleSwitch',
  emits: ['toggle'],
  setup(props, context) {
    const isChecked = ref(false);

    const emitChangeEvent = () => {
      context.emit('toggle', isChecked.value);
    };

    return { isChecked, emitChangeEvent }
  }
}
</script>

<style lang="scss" scoped>
@import "form-toggle-switch";
</style>

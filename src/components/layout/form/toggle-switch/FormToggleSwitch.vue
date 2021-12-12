<template>
  <label class="switch">
    <input type="checkbox" v-model="isChecked" @change="emitChangeEvent">
    <span class="round-slider"></span>
  </label>
</template>

<script>
import {onMounted, ref} from "vue";

export default {
  name: 'FormToggleSwitch',
  emits: ['toggle'],
  props: {
    startValue: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  setup(props, context) {
    const isChecked = ref(false);

    onMounted(() => {
      isChecked.value = props.startValue;
    });

    const emitChangeEvent = () => {
      context.emit('toggle', isChecked.value);
    };

    const restoreValue = () => {
      isChecked.value = !isChecked.value;
    };

    const getValue = () => {
      return isChecked.value;
    };

    return { isChecked, getValue, restoreValue, emitChangeEvent }
  }
}
</script>

<style lang="scss" scoped>
@import "form-toggle-switch";
</style>

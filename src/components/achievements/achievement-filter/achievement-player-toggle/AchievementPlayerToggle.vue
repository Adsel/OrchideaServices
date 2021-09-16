<template>
  <div class="by-player-switcher">
    <span>{{ label }}</span>
    <FormToggleSwitch v-model="isFilteredByPlayer" @toggle="filterByPlayer"></FormToggleSwitch>
  </div>
</template>

<script>
import {ref} from "vue";
import FormToggleSwitch from "../../../layout/form/toggle-switch/FormToggleSwitch";

export default {
  name: 'AchievementPlayerToggle',
  components: {FormToggleSwitch},
  emits: ['filter-by-players'],
  props: {
    label: {
      type: String,
      required: true
    }
  },
  setup(props, context) {
    const isFilteredByPlayer = ref(false);

    const filterByPlayer = (isChecked) => {
      isFilteredByPlayer.value = isChecked;
      context.emit('filter-by-players', isChecked);
    };

    return { isFilteredByPlayer, filterByPlayer }
  }
}
</script>

<style scoped lang="scss">
@import "achievement-player-toggle";
</style>

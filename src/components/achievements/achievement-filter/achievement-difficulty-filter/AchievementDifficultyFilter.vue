<template>
  <div class="basic-filter">
    <label for="difficultFilter" class="py-1">Rodzaj</label>
    <div id="difficultFilter" class="difficult-filter">
      <button v-for="filterButton in FILTER_BUTTONS"
              :key="filterButton.id"
              class="btn"
              :class="getFilterButtonClasses(filterButton)"
              @click="activateFilter(filterButton)">
        {{ filterButton.name }}
      </button>
    </div>
    <small>Wybierz rodzaj</small>
  </div>
</template>
<script>
import {ref} from "vue";
import {
  ACHIEVEMENT_TYPE_LABEL_HARD,
  ACHIEVEMENT_TYPE_LABEL_LABORIOUS, ACHIEVEMENT_TYPE_LABEL_MAIN,
  ACHIEVEMENT_TYPE_LABEL_NORMAL, ACHIEVEMENT_TYPE_LABEL_STARTING, reTranslateAchievementType
} from "@/assets/js/helpers/achievement";

const FILTER_BUTTONS = [
  {id: 1, name: ACHIEVEMENT_TYPE_LABEL_STARTING, class: 'starting-btn'},
  {id: 2, name: ACHIEVEMENT_TYPE_LABEL_MAIN, class: 'main-btn'},
  {id: 3, name: ACHIEVEMENT_TYPE_LABEL_NORMAL, class: 'normal-btn'},
  {id: 4, name: ACHIEVEMENT_TYPE_LABEL_HARD, class: 'hard-btn'},
  {id: 5, name: ACHIEVEMENT_TYPE_LABEL_LABORIOUS, class: 'laborious-btn'}
];

const FILTER_BUTTON_INACTIVE_CLASS = 'inactive';

export default {
  name: 'AchievementDifficultyFilter',
  setup() {
    const activeFilter = ref([]);

    const activateFilter = (filterButton) => {
      const found = activeFilter.value.find(active => active.id === filterButton.id);
      if (found) {
        activeFilter.value = activeFilter.value.filter(active => active.id !== filterButton.id);
      } else {
        activeFilter.value.push(filterButton);
      }
    };

    const getFilterButtonClasses = (filterButton) => {
      let classObject = {};

      const isActive = activeFilter.value.find(active => active.id === filterButton.id);
      classObject[FILTER_BUTTON_INACTIVE_CLASS] = !isActive;
      classObject[filterButton.class] = true;

      return classObject;
    };

    const getDifficulty = () => activeFilter.value.map(active => reTranslateAchievementType(active?.name));

    return {activeFilter, activateFilter, FILTER_BUTTONS, getDifficulty, getFilterButtonClasses};
  }
}
</script>
<style scoped lang="scss">
@import 'achievement-difficulty-filter';
@import '../../../../../src/assets/scss/variables';

.inactive {
  background-color: $color-dark !important;
}
</style>

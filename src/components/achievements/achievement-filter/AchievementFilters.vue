<template>
  <div class="filter-wrapper">
    <div class="filter-title">
      <h2 class="filter-title-header">Filtruj osiągnięcia</h2>
    </div>
    <div class="filters">
      <AchievementSingleFilter title="Treść zadania"
                               description="Pozostaw puste, aby wyświetlić wszystkie"
                               placeholder="Treść" ref="achievementContent"></AchievementSingleFilter>
      <AchievementDifficultyFilter ref="difficultyFilter"></AchievementDifficultyFilter>
      <AchievementPlayerToggle @filter-by-players="filterByPlayer($event)"
                               label="Szukaj po graczu"></AchievementPlayerToggle>
      <template v-if="isFilteredByPlayer">
        <AchievementSingleFilter title="ID profilu" description="Pozostaw puste, aby wyświetlić wszystkie"
                                 placeholder="ID" ref="nicknameFilter"></AchievementSingleFilter>
        <AchievementSingleFilter title="Nick gracza*"
                                 description="Pozostaw puste, aby wyświetlić wszystkie (dostępne wkrótce)"
                                 placeholder="Nick"></AchievementSingleFilter>
      </template>
      <div class="filter-operations">
        <button class="btn" @click="filter">
          <i class="fas fa-search"></i>
          Ustaw filtr
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import AchievementDifficultyFilter from "./achievement-difficulty-filter/AchievementDifficultyFilter";
import AchievementSingleFilter from "./achievement-single-filter/AchievementSingleFilter";

import {ref} from "vue";
import AchievementPlayerToggle from "./achievement-player-toggle/AchievementPlayerToggle";

export default {
  name: 'AchievementFilters',
  emits: [
    'filter'
  ],
  components: {
    AchievementDifficultyFilter,
    AchievementPlayerToggle,
    AchievementSingleFilter
  },
  setup(props, context) {
    const isFilteredByPlayer = ref(false);
    const achievementContent = ref('');
    const difficultyFilter = ref(null);
    const nicknameFilter = ref('');

    const filterByPlayer = (value) => {
      isFilteredByPlayer.value = value;
    };

    const filter = () => {
      context.emit('filter', {
        description: achievementContent.value.getInputValue(),
        profile_id: isFilteredByPlayer.value ? nicknameFilter.value.getInputValue() : null,
        difficulty: difficultyFilter.value.getDifficulty()
      });
    };

    return {isFilteredByPlayer, achievementContent, difficultyFilter, nicknameFilter, filterByPlayer, filter};
  }
}
</script>
<style scoped lang="scss">
@import "achievement-filter";
</style>

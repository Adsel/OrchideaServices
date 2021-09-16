<template>
  <div class="filter-wrapper">
    <div class="filter-title">
      <h2 class="filter-title-header">Filtruj osiągnięcia</h2>
    </div>

    <div class="filters">
      <AchievementSingleFilter title="Nazwa zadania" description="Pozostaw puste, aby wyświetlić wszystkie"
                               placeholder="Nazwa"></AchievementSingleFilter>

      <AchievementDifficultyFilter></AchievementDifficultyFilter>

      <AchievementPlayerToggle @filter-by-players="filterByPlayer($event)"
                               label="Szukaj po graczu"></AchievementPlayerToggle>

      <template v-if="isFilteredByPlayer">
        <AchievementSingleFilter title="Nick gracza" description="Pozostaw puste, aby wyświetlić wszystkie"
                                 placeholder="Nick"></AchievementSingleFilter>

        <AchievementSingleFilter title="ID profilu" description="Pozostaw puste, aby wyświetlić wszystkie"
                                 placeholder="ID"></AchievementSingleFilter>
      </template>

      <div class="filter-operations">
        <button class="btn">
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
import AchievementPlayerToggle from "./achievement-player-toggle/AchievementPlayerToggle";
import {ref} from "vue";

export default {
  name: 'AchievementFilters',
  components: {
    AchievementDifficultyFilter,
    AchievementPlayerToggle,
    AchievementSingleFilter
  },
  setup() {
    const isFilteredByPlayer = ref(false);

    const filterByPlayer = (value) => {
      isFilteredByPlayer.value = value;
    };

    return { isFilteredByPlayer, filterByPlayer }
  }
}
</script>

<style scoped lang="scss">
@import "achievement-filter";
</style>

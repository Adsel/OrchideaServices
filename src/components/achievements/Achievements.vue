<template>
  <Subpage>
    <div class="row py-3">
      <div class="achievements-wrapper col-md-12">
        <AchievementFilters class="achievements-filter" @filter="onFilter"></AchievementFilters>
        <AchievementList ref="achievementList"></AchievementList>
      </div>
    </div>
  </Subpage>
</template>
<script>
import {ref} from "vue";
import Subpage from "../layout/subpage/Subpage";
import AchievementFilters from "./achievement-filter/AchievementFilters";
import AchievementList from "./achievement-list/AchievementList";

export default {
  components: {
    AchievementFilters,
    AchievementList,
    Subpage
  },
  setup() {
    const achievementList = ref(null);

    const onFilter = (event) => {
      achievementList.value.filterAchievements(event);
    };

    return {achievementList, onFilter};
  }
}
</script>
<style lang="scss" scoped>
@import "../../assets/scss/shared";

.achievements-wrapper {
  @include customScrollbarY($color-dark);

  background-color: $color-dark;
  overflow-y: scroll;
  display: flex;
  padding: 0;
  margin: 0;

  & > .achievements-filter {
    max-width: 25rem;
    width: 25rem;
  }
}
</style>

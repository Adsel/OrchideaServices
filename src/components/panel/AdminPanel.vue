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

  }
}
</script>
<style lang="scss" scoped>
@import "../../assets/scss/shared";

  @include customScrollbarY($color-dark);
</style>

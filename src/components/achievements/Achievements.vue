<template>
  <Subpage>
    <div class="row py-3">
      <div class="achievements-wrapper col-md-12">
        <AchievementFilters class="achievements-filter"></AchievementFilters>
        <AchievementList></AchievementList>
      </div>
    </div>
  </Subpage>
</template>

<script>
import Subpage from "../layout/subpage/Subpage";
import AchievementFilters from "./achievement-filter/AchievementFilters";
import AchievementList from "./achievement-list/AchievementList";

export default {
  components: {
    AchievementFilters,
    AchievementList,
    Subpage
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

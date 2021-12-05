<template>
  <div class="achievement-list">
    <!--    <AchievementCard title="Task name" :state-exists="true" description="Krótki opis zadania do wykonania"></AchievementCard>-->
    <!--    <AchievementCard title="Task name" :state-exists="true" :done="true" description="Krótki opis zadania do wykonania"></AchievementCard>-->
    <!--    <AchievementCard title="Task name" description="Krótki opis zadania do wykonania"></AchievementCard>-->
    <template v-for="achievement in achievementList" :key="achievement.achievement_id">
      <AchievementCard :description="achievement.number + '. ' + achievement.description" :achievement-type="achievement.achievement_type"
                       :title="achievement.achievement_type.name" :done="!!achievement.done ? achievement.done : false"
                       :state-exists="isFilterByPlayer"></AchievementCard>
    </template>
  </div>
</template>
<script>
import {ref, onMounted} from "vue";
import AchievementCard from "./achievement-card/AchievementCard";
import {getAchievements, getFilteredAchievements} from "../../../assets/js/api/achievement";

export default {
  name: 'AchievementList',
  components: {AchievementCard},
  setup() {
    const achievementList = ref([]);
    const isFilterByPlayer = ref(false);

    onMounted(() => {
      getAchievements().then((results) => {
        if (!!results && !!results.achievements) {
          achievementList.value = results.achievements;
        }
      }).catch((err) => {
        console.log(err);
      });
    });

    const filterAchievements = (filter) => {
      const filterData = filter;
      console.log('filterAchievements', filterData);

      getFilteredAchievements(filterData).then((results) => {
        console.log(`getFilteredAchievements(${filterData})`, results);
        if (!!results && !!results.achievements) {
          achievementList.value = results.achievements;
        }
        isFilterByPlayer.value = !!filterData && (!!filterData.profile_id || !!filterData.nickname);
      }).catch((err) => {
        console.log(`getFilteredAchievements(${filterData}) err`, err);
      });
    };

    return {achievementList, isFilterByPlayer, filterAchievements}
  }
}
</script>
<style scoped lang="scss">
@import "../../../assets/scss/shared";

.achievement-list {
  background-color: $color-dark;
  width: calc(100% - 400px - 4rem);
  margin: 2rem 0 0 2rem;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}
</style>

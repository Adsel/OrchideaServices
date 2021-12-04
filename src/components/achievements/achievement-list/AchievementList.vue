<template>
  <div class="achievement-list">
    <!--    <AchievementCard title="Task name" :state-exists="true" description="Krótki opis zadania do wykonania"></AchievementCard>-->
    <!--    <AchievementCard title="Task name" :state-exists="true" :done="true" description="Krótki opis zadania do wykonania"></AchievementCard>-->
    <!--    <AchievementCard title="Task name" description="Krótki opis zadania do wykonania"></AchievementCard>-->
    <template v-for="achievement in achievementList" :key="achievement.achievement_id">
      <AchievementCard :description="achievement.description" :achievement-type="achievement.achievement_type"
                       :title="achievement.number"></AchievementCard>
    </template>
  </div>
</template>
<script>
import {ref, onMounted} from "vue";
import AchievementCard from "./achievement-card/AchievementCard";
import {getAchievements} from "../../../assets/js/api/achievement";

export default {
  name: 'AchievementList',
  components: {AchievementCard},
  setup() {
    const achievementList = ref([]);

    onMounted(() => {
      getAchievements().then((results) => {
        if (!!results && !!results.achievements) {
          console.error('results', results);
          achievementList.value = results.achievements;
        }
      }).catch((err) => {
        console.log(err);
      });
    });

    return {achievementList}
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

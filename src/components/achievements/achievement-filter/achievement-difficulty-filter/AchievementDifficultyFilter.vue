<template>
  <div class="basic-filter">
    <label for="difficultFilter" class="py-1">Rodzaj</label>
    <div id="difficultFilter" class="difficult-filter">
      <button class="btn starting-btn">Startowe</button>
      <button class="btn main-btn">Główne</button>
      <button class="btn normal-btn">Normalne</button>
      <button class="btn hard-btn">Trudne</button>
      <button class="btn laborious-btn">Pracochłonne</button>
    </div>
    <small>Wybierz rodzaj</small>
  </div>
</template>
<script>
export default {
  name: 'AchievementDifficultyFilter',
}
</script>
<style scoped lang="scss">
@import 'achievement-difficulty-filter';
</style>

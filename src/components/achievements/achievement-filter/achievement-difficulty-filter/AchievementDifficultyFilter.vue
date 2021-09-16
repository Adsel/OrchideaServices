<template>
  <div class="basic-filter">
    <label for="difficultFilter" class="py-1">Poziom</label>

    <div id="difficultFilter" class="difficult-filter">
      <button class="btn easy-btn">Startowe</button>
      <button class="btn intermediate-btn">Łatwe</button>
      <button class="btn hard-btn">Trudne</button>
    </div>

    <small>Ustaw poziom</small>
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

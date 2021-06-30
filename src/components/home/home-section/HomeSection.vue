<template>
  <section>
    <nav>
      <router-link to="/lottery" class="card card-lottery">
        <i class="fas fa-dollar-sign"></i>
        <span>Loteria</span>
      </router-link>
      <router-link to="/achievements" class="card card-achievements">
        <i class="fas fa-trophy"></i>
        <span>Osiągnięcia</span>
      </router-link>
      <a href="https://www.margonem.pl/?task=art&id=44" class="card card-regulations">
        <i class="fas fa-balance-scale"></i>
        <span>Regulamin</span>
      </a>
    </nav>
  </section>
</template>

<script>
export default {}
</script>

<style lang="scss" scoped>
@import "home-section";
</style>

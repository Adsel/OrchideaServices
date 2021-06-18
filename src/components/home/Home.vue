<template>
  <div class="app">
    <Header></Header>
    <div class="container content">
      <HomeAside></HomeAside>
      <HomeSection></HomeSection>
    </div>
  </div>
</template>

<script>
import Header from "./home-header/Header";
import HomeAside from "./home-aside/HomeAside";
import HomeSection from "./home-section/HomeSection";

export default {
  components: {
    Header,
    HomeAside,
    HomeSection
  }
}
</script>

<style lang="scss" scoped>
@import "../../assets/scss/shared";
.app {
  div.content {
    display: flex;
    width: 100%;
    max-width: 100%;
    padding: 0;
    height: calc(100vh - #{$header-height});
  }
}
</style>

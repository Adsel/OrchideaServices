<template>
  <div class="app">
    <HomeHeaderMobile></HomeHeaderMobile>
    <HeaderDesktop></HeaderDesktop>
    <div class="container content">
      <HomeAside></HomeAside>
      <HomeSection></HomeSection>
    </div>
  </div>
</template>

<script>
import HeaderDesktop from "./home-header-desktop/HeaderDesktop";
import HomeAside from "./home-aside-desktop/HomeAsideDesktop";
import HomeSection from "./home-section/HomeSection";
import HomeHeaderMobile from "./home-header-mobile/HomeHeaderMobile";

export default {
  components: {
    HomeHeaderMobile,
    HeaderDesktop,
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

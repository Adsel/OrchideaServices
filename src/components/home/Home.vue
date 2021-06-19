<template>
  <div class="app">
    <HomeHeaderMobile></HomeHeaderMobile>
    <HeaderDesktop></HeaderDesktop>
    <div class="container content">
      <HomeAside></HomeAside>
      <HomeSection></HomeSection>
    </div>
    <FooterMobile></FooterMobile>
  </div>
</template>

<script>
import HeaderDesktop from "../layout/header/header-desktop/HeaderDesktop";
import HomeAside from "./home-aside-desktop/HomeAsideDesktop";
import HomeSection from "./home-section/HomeSection";
import HomeHeaderMobile from "../layout/header/header-mobile/HeaderMobile";
import FooterMobile from "../layout/footer/footer-mobile/FooterMobile";

export default {
  components: {
    FooterMobile,
    HomeHeaderMobile,
    HeaderDesktop,
    HomeAside,
    HomeSection
  }
}
</script>

<style lang="scss" scoped>
@import "../../assets/scss/shared";

.app div.content {
  display: flex;
  width: 100%;
  max-width: 100%;
  padding: 0;

  @include media('lg', 'min') {
    height: calc(100vh - #{$header-height});
  }

  @include media('lg', 'max') {
    overflow: hidden;
  }
}
</style>

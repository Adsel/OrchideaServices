<template>
  <HeaderMobile></HeaderMobile>
  <HeaderDesktop></HeaderDesktop>
  <div class="content pb-4">
    <div class="container">
      <slot></slot>
    </div>
  </div>
  <Footer></Footer>
</template>

<script>
import HeaderMobile from "../header/header-mobile/HeaderMobile";
import HeaderDesktop from "../header/header-desktop/HeaderDesktop";
import Footer from "../footer/footer-mobile/FooterMobile";

export default {
  name: 'Subpage',
  components: {
    HeaderMobile,
    HeaderDesktop,
    Footer
  },
}
</script>

<style lang="scss" scoped>
.footer-mobile {
  display: flex;
}

.content {
  width: 100%;
  background-image: url('../../../assets/image/home_background.png');
  background-size: cover;

  & > .container {
    max-width: 1400px;
  }
}
</style>

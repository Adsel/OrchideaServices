<template>
  <HeaderMobile></HeaderMobile>
  <HeaderDesktop></HeaderDesktop>
  <div class="content">
    <div class="container">
      <LotteryHeading></LotteryHeading>
      <LotteryResult></LotteryResult>
    </div>
  </div>
  <Footer></Footer>
</template>

<script>
import HeaderMobile from "../layout/header/header-mobile/HeaderMobile.vue";
import HeaderDesktop from "../layout/header/header-desktop/HeaderDesktop.vue";
import Footer from "../layout/footer/footer-mobile/FooterMobile.vue";
import LotteryResult from "./lottery-result/LotteryResult.vue";
import LotteryHeading from "./lottery-heading/LotteryHeading.vue";

export default {
  components: {
    HeaderMobile,
    HeaderDesktop,
    Footer,
    LotteryResult,
    LotteryHeading
  },
}
</script>

<style lang="scss" scoped>
.footer-mobile {
  display: block;
}

.content {
  width: 100%;
  background-image: url('../../assets/image/home_background.png');
  background-size: cover;

  & > .container {
    max-width: 1400px;
  }
}
</style>

<template>
  <HeaderMobile></HeaderMobile>
  <HeaderDesktop :admin-side="adminSide" ref="headerRef"></HeaderDesktop>
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
import {ref} from "vue";

export default {
  name: 'Subpage',
  components: {
    HeaderMobile,
    HeaderDesktop,
    Footer
  },
  props: {
    adminSide: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  setup() {
    const headerRef = ref(null);

    const updateAdminInfo = () => {
      headerRef.value.updateAdminInfo();
    };

    return {headerRef, updateAdminInfo};
  }
}
</script>

<style lang="scss" scoped>
@import "../../../assets/scss/shared";

.footer-mobile {
  display: flex;
}

.content {
  @include media('xxl', 'min') {
    min-height: calc(100vh - #{$header-height} - #{$footer-height});
  }

  width: 100%;
  background-image: url('../../../assets/image/home_background.png');
  background-size: cover;

  & > .container {
    max-width: 1400px;
  }
}
</style>

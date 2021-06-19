<template>
  <aside>
    <div className="intro">
      <div className="prolog">
        <img className="prolog-image" src="../../../assets/image/prolog.png">
        <h1 className="prolog-header">Świat Prywatny</h1>
      </div>

      <div class="desc-wrapper">
        <span class="desc">Tutaj znajdziesz</span>
      </div>
    </div>
    <FooterPartial></FooterPartial>
  </aside>
</template>

<script>
import FooterPartial from "../../layout/footer/footer-partial/FooterPartial";

export default {
  components: {
    FooterPartial
  }
}
</script>

<style lang="scss" scoped>
@import 'home-aside-desktop';
</style>

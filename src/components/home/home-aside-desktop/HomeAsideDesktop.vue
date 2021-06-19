<template>
  <aside>
    <div className="intro">
      <div className="prolog">
        <img className="prolog-image" src="../../../assets/image/prolog.png">
        <h1 className="prolog-header">Świat Prywatny</h1>
      </div>

      <div class="desc-wrapper">
        <span class="desc">
          Zobacz wyniki ostatniej <span class="font-weight-bold font-lottery">loterii</span>, aby dowiedzieć się czy udało Ci się coś wygrać.
        </span>
        <br>
        <span class="desc">
          Jeżeli niestraszne Ci wyzwania, niezwłocznie zobacz listę z czekającymi na Ciebie <span class="font-weight-bold font-achievements">osiągnięciami</span>.
        </span>
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

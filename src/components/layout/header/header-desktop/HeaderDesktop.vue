<template>
  <header class="navbar-dark">
    <div class="logo-min">
      <img src="../../../../assets/image/logo.png" alt="logo.png" />
    </div>
    <span class="header-title">
      ORCHIDEA
      <div class="admin-panel__info" v-if="adminSide">AdminPanel</div>
    </span>
    <HeaderLink url="/lottery" label="Loteria"></HeaderLink>
    <HeaderLink url="/achievements" label="Osiągnięcia"></HeaderLink>
    <HeaderLink url="https://www.margonem.pl/?task=art&id=44" label="Regulamin" :is-target-blank="true"></HeaderLink>
  </header>
</template>

<script>
import HeaderLink from "./HeaderDesktopLink";

export default {
  components: {
    HeaderLink
  },
  props: {
    adminSide: {
      type: Boolean,
      required: false,
      default: false
    }
  }
}
</script>

<style lang="scss" scoped>
@import "header-desktop";

.admin-panel__info {
  display: block;
  font-weight: bold;
  color: white;
}
</style>

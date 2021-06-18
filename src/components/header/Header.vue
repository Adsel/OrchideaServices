<template>
  <header>
    <div class="logo-min">
      <img src="../../assets/image/logo.png" alt="logo.png" />
    </div>
    <span class="header-title">ORCHIDEA</span>
    <HeaderLink url="/lottery" label="Loteria"></HeaderLink>
    <HeaderLink url="/achievements" label="Osiągnięcia"></HeaderLink>
    <HeaderLink url="https://www.margonem.pl/?task=art&id=44" label="Regulamin" :is-target-blank="true"></HeaderLink>
  </header>
</template>

<script>
import HeaderLink from "./HeaderLink";

export default {
  components: {
    HeaderLink
  }
}
</script>

<style lang="scss" scoped>
@import "header";
</style>

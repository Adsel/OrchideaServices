<template>
  <div class="container">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
      <div class="logo-min">
        <img src="../../../../assets/image/logo.png" alt="logo.png" />
      </div>
      <span class="navbar-brand">ORCHIDEA</span>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <HomeHeaderMobileLink url="/lottery" label="Loteria"></HomeHeaderMobileLink>
          <HomeHeaderMobileLink url="/achievements" label="Osiągnięcia"></HomeHeaderMobileLink>
          <HomeHeaderMobileLink url="https://www.margonem.pl/?task=art&id=44" label="Regulamin" :is-target-blank="true"></HomeHeaderMobileLink>
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
import HomeHeaderMobileLink from "./HeaderMobileLink";

export default {
  components: {
    HomeHeaderMobileLink
  }
}
</script>

<style lang="scss" scoped>
@import "header-mobile";
</style>

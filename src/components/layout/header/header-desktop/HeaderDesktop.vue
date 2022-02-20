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

    <div class="admin-panel__welcome-wrapper" v-if="loggedAdmin">
          <span class="admin-panel__welcome">
            Zalogowany jako &nbsp;
            <span class="admin-panel__welcome-name">{{ loggedAdmin.visible_name }}</span>
            <button class="btn admin-panel__btn-cta btn-small" @click="logoutAdmin">
              <i class="fas fa-sign-out-alt"></i>
            </button>
          </span>
    </div>
  </header>
</template>

<script>
import HeaderLink from "./HeaderDesktopLink";
import {onMounted, ref} from "vue";
import {getLoggedAdmin, logoutAdmin} from "@/assets/js/helpers/admin";

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
  },
  setup() {
    const loggedAdmin = ref(null);

    onMounted(() => {
      updateAdminInfo();
    });

    const updateAdminInfo = () => {
      loggedAdmin.value = getLoggedAdmin();
    };

    return {loggedAdmin, logoutAdmin, updateAdminInfo};
  }
}
</script>

<style lang="scss" scoped>
@import "header-desktop";

.admin-panel {
  &__info {
    display: block;
    font-weight: bold;
    color: white;
  }

  &__welcome {
    color: $color-ash;
    font-size: 1.125rem;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  &__welcome-name {
    color: $color-yellow;
    font-weight: bold;
  }

  &__welcome-wrapper {
    margin-left: auto;
  }

  &__btn-cta {
    color: $color-red;
  }
}
</style>

<template>
  <div>
    <router-link class="nav-link" :to="url" :target="target" v-if="!isTargetBlank">
      {{ label }}
    </router-link>
    <a :href="url" class="nav-link" :target="target" v-else>
      {{ label }}
    </a>
  </div>
</template>

<script>
import {computed} from "vue";

export default {
  props: {
    url: {
      type: String,
      required: true
    },
    label: {
      type: String,
      required: true
    },
    isTargetBlank: {
      type: Boolean,
      default: false
    }
  },
  setup(props) {
    const target = computed(() => {
      return props.isTargetBlank ? '_blank' : '_self';
    });

    return { target }
  }
}
</script>

<style lang="scss" scoped>
@import "../../../../assets/scss/shared";

.nav-link {
  color: $color-navbar-link;

  &:hover {
    color: $color-navbar-link-hover;
  }
}
</style>

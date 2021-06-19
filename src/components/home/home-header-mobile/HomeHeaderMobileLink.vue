<template>
  <li class="nav-item">
    <router-link class="nav-link" :to="url" :target="target" v-if="!isTargetBlank">
      {{ label }}
    </router-link>
    <a class="nav-link" :href="url" :target="target" v-else>
      {{ label }}
    </a>
  </li>
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

<template>
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center">{{ resultTitle }}</h2>
    </div>
  </div>
</template>

<script>
import {onMounted, ref, watch} from "vue";

export default {
  props: {
    title: {
      type: String,
      required: false,
      default: 'Wyniki z poprzedniej loterii'
    }
  },
  setup(props) {
    const resultTitle = ref('');

    onMounted(() => {
      resultTitle.value = props.title;
    })

    watch(() => props.title, () => {
      resultTitle.value = props.title;
    });

    return {resultTitle}
  }
}
</script>

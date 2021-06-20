<template>
  <div class="result-column">
    <span class="number">{{ number }}.</span>
    <div>reward</div>
    <div>badge</div>
  </div>
</template>

<script>
export default {
  props: {
    number: {
      type: Number,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
@import "lottery-result-column";
</style>

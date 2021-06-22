<template>
  <div class="result-column" :id="'result' + number">
    <span class="number">{{ number }}.</span>
    <div class="result-content">
      <div class="reward-wrapper">
        <div class="avatar">
          <i class="reward-icon fas"></i>
        </div>
        <span class="reward"></span>
      </div>
      <div class="badge-wrapper">
        <span class="badge badge-primary"></span>
      </div>
    </div>
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

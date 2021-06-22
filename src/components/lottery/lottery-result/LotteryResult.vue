<template>
  <div class="row">
    <template v-for="(number, index) in resultCount" :key="index">
      <LotteryResultColumn :number="number"></LotteryResultColumn>
    </template>
  </div>
</template>

<script>
import LotteryResultColumn from "./lottery-result-column/LotteryResultColumn";

export default {
  components: {
    LotteryResultColumn
  },
  setup() {
    const resultCount = 100;

    return {resultCount}
  }
}
</script>

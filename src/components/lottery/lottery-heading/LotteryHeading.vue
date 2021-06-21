<template>
  <div class="row py-3">
    <h1 class="col-md-12 title">Następna loteria za:</h1>
    <div class="col-md-12 timer">
      <span>{{ timeString.days }} dni </span>
      <span>{{ timeString.hours }} godz. </span>
      <span>{{ timeString.minutes }} min </span>
      <span>{{ timeString.seconds }} sek. </span>
    </div>
  </div>
</template>

<script>
import {onMounted, ref} from "vue";
import {countDownHelper} from "../../../assets/js/helpers/time";
import {getTimer} from "../../../assets/js/api/lottery";

export default {
  setup() {
    const timer = ref(null);
    const timeString = ref({
      days: '0',
      hours: '00',
      minutes: '00',
      seconds: '00'
    });

    onMounted(() => {
      initTimer();
    });

    const startCounting = (currentTime, destinationTime) => {
      const countDownDate = new Date(
          destinationTime.year,
          destinationTime.month,
          destinationTime.day,
          destinationTime.hour,
          destinationTime.minute,
          destinationTime.second
      ).getTime();

      const currentTimeDate = new Date (
          currentTime.year,
          currentTime.month,
          currentTime.day,
          currentTime.hour,
          currentTime.minute,
          currentTime.second
      );

      countDown(countDownDate, currentTimeDate);
      timer.value = setInterval(() => {
        countDown(countDownDate, currentTimeDate);
      }, 1000);
    }

    const countDown = (countDownDate, currentTimeDate) => {
      const countDownString = countDownHelper(countDownDate, currentTimeDate);

      timeString.value = {
        days: countDownString.days,
        hours: countDownString.hours,
        minutes: countDownString.minutes,
        seconds: countDownString.seconds
      };
      currentTimeDate.setSeconds(currentTimeDate.getSeconds() + 1);

      if (countDownString.distance < 0) {
        clearInterval(timer.value);
      }
    }

    const initTimer = () => {
      getTimer().then((results) => {
        if (!!results && !!results.currentDatetime && !!results.destinationDatetime) {
          startCounting(results.currentDatetime, results.destinationDatetime);
        }
      });
    }

    return {timeString}
  }
}
</script>

<style lang="scss" scoped>
h1.title {
  font-size: 1.5rem;
}

.timer {
  font-size: 3.5rem;
}
</style>

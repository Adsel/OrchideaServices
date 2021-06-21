<template>
  <div class="row">
    <template v-for="(number, index) in resultCount" :key="index">
      <LotteryResultColumn :number="number"></LotteryResultColumn>
    </template>
  </div>
</template>

<script>
import LotteryResultColumn from "./lottery-result-column/LotteryResultColumn";
import {onMounted} from "vue";
import {CURRENCY_ICON_CLASS, MONEY_ICON_CLASS, SHARD_ICON_CLASS, TICKET_ICON_CLASS} from "../../../assets/js/variables/lottery";
import {getAwards, getPlayerNicknames} from "../../../assets/js/api/lottery";

export default {
  components: {
    LotteryResultColumn
  },
  setup() {
    const resultCount = 100;

    onMounted(() => {
      getResult();
    });

    const drawResult = (date, results) => {
      const rewards = JSON.parse(results);

      for (const [index, rewardVal] of Object.entries(rewards)) {
        if (index === 'month' || index === 'year') {
          continue;
        }

        let rewardIconClass;
        let reward;
        const resultDiv = document.getElementById('result' + index);
        reward = rewardVal;

        if (rewardVal == "odlamek postaci") {
          resultDiv.classList.add('award-shard');
          reward = 'odłamek postaci'
          rewardIconClass = SHARD_ICON_CLASS;
        } else if (rewardVal == "strzal") {
          resultDiv.classList.add('award-ticket');
          reward = 'dodatkowy strzał';
          rewardIconClass = TICKET_ICON_CLASS;
        } else if (rewardVal.indexOf("kw.") > -1 || rewardVal.indexOf('zniżki') > -1) {
          resultDiv.classList.add('award-currency');
          rewardIconClass = CURRENCY_ICON_CLASS;
        } else if (reward.indexOf("m") > -1) {
          resultDiv.classList.add('award-gold');
          rewardIconClass = MONEY_ICON_CLASS;
        } else {
          continue;
        }

        resultDiv.querySelector('.reward-icon').classList.add(rewardIconClass);
        resultDiv.querySelector('.reward').innerHTML = reward;
        resultDiv.querySelector('.badge').innerHTML = 'nickname';
      }
    };

    const getResult = () => {
      getAwards().then((results) => {
        if (!!results && !!results.result && !!results.result.date && !!results.result.rewards) {
          drawResult(results.result.date, results.result.rewards);
          loadNicknames(results.result.date);
        }
      }).catch((err) => {
        console.log(err);
      });
    };

    const loadNicknames = () => {
      getPlayerNicknames().then((results) => {
        if (!!results && !!results.nicknames && !!results.month && !!results.year) {
          drawNicknames(results.nicknames);

          // vm.resultsTitle = results.month + " " + results.year;
        }
      }).catch((err) => {
        console.log(err);
      });
    };

    const drawNicknames = (nicknames) => {
      console.log('nicknames', nicknames);
      // jQuery.each(nicknames, (index, nick) => {
      //   const resultDiv =  $("#" + index);
      //   resultDiv.find('.avatar').append('&nbsp; ' + nick);
      // });
    };

    return {resultCount}
  }
}
</script>

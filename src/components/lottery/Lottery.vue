<template>
  <Subpage>
    <LotteryHeading></LotteryHeading>
    <LotteryResultHeader :title="title"></LotteryResultHeader>
    <LotteryResult></LotteryResult>
  </Subpage>
</template>

<script>
import LotteryResult from "./lottery-result/LotteryResult.vue";
import LotteryHeading from "./lottery-heading/LotteryHeading.vue";
import LotteryResultHeader from "./lottery-result/lottery-result-header/LotteryResultHeader.vue";
import Subpage from "../layout/subpage/Subpage.vue";
import {onMounted, ref} from "vue";
import {
  CURRENCY_ICON_CLASS,
  MONEY_ICON_CLASS,
  SHARD_ICON_CLASS,
  TICKET_ICON_CLASS
} from "../../assets/js/variables/lottery";
import {getAwards, getPlayerNicknames} from "../../assets/js/api/lottery";


export default {
  components: {
    LotteryHeading,
    LotteryResultHeader,
    LotteryResult,
    Subpage
  },
  setup() {
    const title = ref();

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
        } else if (rewardVal === 'strzal' || rewardVal === 'strzal x2') {
          resultDiv.classList.add('award-ticket');
          reward = rewardVal === 'strzal' ? 'dodatkowy strzał' : 'dodatkowy strzał x2';
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
          title.value = `Wyniki ${results.month} ${results.year}`;
        }
      }).catch((err) => {
        console.log(err);
      });
    };

    const drawNicknames = (nicknames) => {
      if (nicknames) {
        for (const [index, nick] of Object.entries(nicknames)) {
          const resultDiv = document.getElementById(`result${index}`);
          resultDiv.querySelector('.badge').append(nick);
        }
      }
    };

    return {title}
  }
}
</script>

<template>
  <HeaderMobile></HeaderMobile>
  <HeaderDesktop></HeaderDesktop>
  <div class="content pb-4">
    <div class="container">
      <LotteryHeading></LotteryHeading>
      <LotteryResultHeader :title="title"></LotteryResultHeader>
      <LotteryResult></LotteryResult>
    </div>
  </div>
  <Footer></Footer>
</template>

<script>
import HeaderMobile from "../layout/header/header-mobile/HeaderMobile.vue";
import HeaderDesktop from "../layout/header/header-desktop/HeaderDesktop.vue";
import Footer from "../layout/footer/footer-mobile/FooterMobile.vue";
import LotteryResult from "./lottery-result/LotteryResult.vue";
import LotteryHeading from "./lottery-heading/LotteryHeading.vue";
import {onMounted, ref} from "vue";
import {
  CURRENCY_ICON_CLASS,
  MONEY_ICON_CLASS,
  SHARD_ICON_CLASS,
  TICKET_ICON_CLASS
} from "../../assets/js/variables/lottery";
import {getAwards, getPlayerNicknames} from "../../assets/js/api/lottery";
import LotteryResultHeader from "./lottery-result/lottery-result-header/LotteryResultHeader";

export default {
  components: {
    LotteryResultHeader,
    HeaderMobile,
    HeaderDesktop,
    Footer,
    LotteryResult,
    LotteryHeading
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
      console.log('nicknames', nicknames);
      if (nicknames) {
        for (const [index, nick] of Object.entries(nicknames)) {
          console.log('IT', index, nick);
          const resultDiv = document.getElementById(`result${index}`);
          console.log('CHECK', `result${index}`);
          resultDiv.querySelector('.badge').append(nick);
        }
      }
    };

    return {title}
  }
}
</script>

<style lang="scss" scoped>
.footer-mobile {
  display: flex;
}

.content {
  width: 100%;
  background-image: url('../../assets/image/home_background.png');
  background-size: cover;

  & > .container {
    max-width: 1400px;
  }
}
</style>

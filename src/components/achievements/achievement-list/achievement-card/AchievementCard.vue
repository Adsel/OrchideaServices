<template>
  <div class="achievement">
    <div class="achievement-title" v-bind:class="{
        'achievement-starting': !!achievementType && achievementType.name === 'STARTING',
        'achievement-main': !!achievementType && achievementType.name === 'MAIN',
        'achievement-normal': !!achievementType && achievementType.name === 'NORMAL',
        'achievement-hard': !!achievementType && achievementType.name === 'HARD',
        'achievement-laborious': !!achievementType && achievementType.name === 'LABORIOUS'
      }">
      {{ getTitle(title) }}
    </div>
    <div>
      <i class="fas fa-coins award-coins"></i>
      {{ !!achievementType && !!achievementType.award_gold ? `${achievementType.award_gold} m` : 'nagroda całościowa' }}
    </div>
    <div>
      <i class="fas fa-money-bill-wave award-currency"></i>
      {{
        !!achievementType && !!achievementType.award_currency ? `${achievementType.award_currency} kw.` : 'nagroda całościowa'
      }}
    </div>
    <div v-if="!!description" class="achievement-card__description">
      {{ description }}
    </div>
    <div class="achievement-state" v-if="stateExists">
      <i v-if="done" class="fas fa-check"></i>
      <i v-else class="fas fa-times"></i>
    </div>
  </div>
</template>
<script>
export default {
  name: 'AchievementCard',
  props: {
    title: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: false
    },
    done: {
      type: Boolean,
      required: false,
      default: false
    },
    stateExists: {
      type: Boolean,
      required: false,
      default: false
    },
    achievementType: {
      type: Object,
      required: false,
      default: null
    }
  },
  setup(props) {
    const getTitle = () => {
      let translatedTitle = '';

      switch (props.title) {
        case 'STARTING': translatedTitle = 'Startowe'; break;
        case 'MAIN': translatedTitle = 'Główne'; break;
        case 'NORMAL': translatedTitle = 'Normalne'; break;
        case 'HARD': translatedTitle = 'Trudne'; break;
        case 'LABORIOUS': translatedTitle = 'Wymagające'; break;
      }

      return translatedTitle;
    };

    return { getTitle }
  }
}
</script>
<style lang="scss" scoped>
@import "achievement-card";
</style>

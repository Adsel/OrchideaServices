<template>
  <div class="achievement__description">
      <span class="achievement__title" v-bind:class="getAchievementClasses(achievement.achievement_type)">
        {{ getTitle(achievement.achievement_type.name) }}
      </span>
    <span>
          <span class="mr-1">{{ achievement.number }} . {{ achievement.description }}</span>
          <i v-if="!!achievement.done" class="fas fa-check"></i>
          <i v-else class="fas fa-times"></i>
        </span>
  </div>
  <template v-for="i in [achievement.achievement_id]" :key="i">
    <FormToggleSwitch :start-value="achievement.done" :ref="(el) => toggler = el"
                      @toggle="changeAchievementStatus(achievement)"></FormToggleSwitch>
  </template>
</template>
<script>
import FormToggleSwitch from "../../../layout/form/toggle-switch/FormToggleSwitch";
import {ref} from "vue";
import {translateAchievementType} from "@/assets/js/helpers/achievement";

export default {
  emits: [
      'change-achievement-status'
  ],
  components: {
    FormToggleSwitch
  },
  props: {
    profileId: {
      type: String,
      required: false,
      default: ''
    },
    achievement: {
      type: Object,
      required: true
    }
  },
  setup(props, context) {
    const toggler = ref(null);
    const changeAchievementStatus = (achievement) => {
      context.emit('change-achievement-status', {
        achievement,
        toggler
      });
    };

    const getAchievementClasses = (type) => {
      return {
        'achievement-starting': !!type && type.name === 'STARTING',
        'achievement-main': !!type && type.name === 'MAIN',
        'achievement-normal': !!type && type.name === 'NORMAL',
        'achievement-hard': !!type && type.name === 'HARD',
        'achievement-laborious': !!type && type.name === 'LABORIOUS'
      }
    };


    const getTitle = (title) => {
      return translateAchievementType(title);
    };

    return {
      toggler,
      getAchievementClasses,
      changeAchievementStatus,
      getTitle
    };
  }
}
</script>
<style lang="scss" scoped>
@import "panel-achievement-status";
</style>

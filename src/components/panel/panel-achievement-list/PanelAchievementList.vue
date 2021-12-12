<template>
  <div v-if="achievementList.length > 0" class="achievement-list__wrapper mt-2">
    <h1 class="achievement-list__header">
      Lista osiągnięć
    </h1>
    <h2>
      Gracz o identyfikatorze:
      <span class="achievement-list__profile-id">{{ profileId }}</span>
    </h2>
    <div v-for="achievement in achievementList" :key="achievement.achievement_id" class="achievement__details"
         v-bind:class="getAchievementDivClasses(achievement.achievement_type)">
      <PanelAchievementStatus :achievement="achievement" :profile-id="profileId"
                              @change-achievement-status="changeAchievementStatusModal"></PanelAchievementStatus>
    </div>
    <AchievementStateConfirmation ref="achievementActionModal" @cancel-action="cancelAction"
                                  @execute-action="executeAction"></AchievementStateConfirmation>
  </div>
</template>
<script>
import PanelAchievementStatus from "./panel-achievement-status/PanelAchievementStatus";
import AchievementStateConfirmation from "./AchievementStateConfirmation";
import {ref} from "vue";
import {changeAchievementState} from "../../../assets/js/api/achievement";

export default {
  components: {
    PanelAchievementStatus,
    AchievementStateConfirmation
  },
  props: {
    achievementList: {
      type: Array,
      required: false,
      default: new Array()
    },
    profileId: {
      type: String,
      required: false,
      default: ''
    },
  },
  setup(props) {
    const achievementActionModal = ref(null);

    // TODO:
    // eliminate duplicate and split into pure function or helper or sth
    const getAchievementDivClasses = (type) => {
      return {
        'achievement-starting': !!type && type.name === 'STARTING',
        'achievement-main': !!type && type.name === 'MAIN',
        'achievement-normal': !!type && type.name === 'NORMAL',
        'achievement-hard': !!type && type.name === 'HARD',
        'achievement-laborious': !!type && type.name === 'LABORIOUS'
      }
    };

    const changeAchievementStatusModal = (event) => {
      console.log('changeAchievementStatusModal', event);
      achievementActionModal.value.setAchievement(event.achievement, event.toggler);
      achievementActionModal.value.toggleModal();

    };

    const cancelAction = (toggler) => {
      console.log('cancelAction', toggler.value);
      toggler.value.restoreValue();
    };

    const executeAction = (event) => {
      const achievementData = {
        profile_id: props.profileId,
        achievement_id: event.achievement.achievement_id,
        status: event.toggler.value.getValue()
      };
      changeAchievementState(achievementData).then((results) => {
        console.log(`changeAchievementState(${achievementData})`, results);
      }).catch((err) => {
        console.log(`getFilteredAchievements(${achievementData}) err`, err);
        cancelAction();
      });
    };

    return {achievementActionModal, cancelAction, changeAchievementStatusModal, executeAction, getAchievementDivClasses};
  }
}
</script>
<style lang="scss" scoped>
@import "../../../assets/scss/shared";

.achievement {
  &__details {
    color: $color-white;
    justify-content: space-between;
    display: flex;
    margin-bottom: 0.5rem;
    padding: 0.5rem;
    // TODO:
    // split radius into shared definitions
    border-radius: .375rem;
  }
}

.achievement-list {
  &__wrapper {
    color: white;
  }

  &__profile-id, &__header {
    color: $color-yellow;
  }
}

$hover-color-change: 20%;
div.achievement-starting {
  &:hover {
    background-color: lighten($color-green, $hover-color-change);
  }

  & > > > input:checked + .round-slider {
    background-color: $color-green;
  }

  & > > > input:focus + .round-slider {
    box-shadow: 0 0 0.063 $color-green;
  }
}

$hover-color-change: 15%;
div.achievement-main {
  &:hover {
    background-color: lighten($color-light-blue, $hover-color-change);
  }

  & > > > input:checked + .round-slider {
    background-color: $color-light-blue
  }

  & > > > input:focus + .round-slider {
    box-shadow: 0 0 0.063 $color-light-blue;
  }
}

div.achievement-normal {
  // TODO:
  // split achievement colors into shared variables
  $color: lighten($color-red, 10%);

  &:hover {
    background-color: lighten($color, $hover-color-change);
  }

  & > > > input:checked + .round-slider {
    background-color: $color;
  }

  & > > > input:focus + .round-slider {
    box-shadow: 0 0 0.063 $color;
  }
}

div.achievement-hard {
  &:hover {
    background-color: lighten($color-red, $hover-color-change);
  }

  & > > > input:checked + .round-slider {
    background-color: $color-red;
  }

  & > > > input:focus + .round-slider {
    box-shadow: 0 0 0.063 $color-red;
  }
}

div.achievement-laborious {
  // TODO:
  // split achievement colors into shared variables
  $color: darken($color-red, 10%);

  &:hover {
    background-color: lighten($color, $hover-color-change);
  }

  & > > > input:checked + .round-slider {
    background-color: $color;
  }

  & > > > input:focus + .round-slider {
    box-shadow: 0 0 0.063 $color;
  }
}
</style>


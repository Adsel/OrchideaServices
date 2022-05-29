<template>
  <div v-if="achievementList.length > 0" class="achievement-list__wrapper">
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
                              @change-achievement-status="changedAchievementValue"></PanelAchievementStatus>
    </div>
    <AchievementStateConfirmation ref="achievementActionModal" @cancel-action="cancelAction"
                                  @execute-action="executeAction"></AchievementStateConfirmation>
    <div class="achievement-list__achievement-cta">
      <button class="btn" @click="changeAchievementStatusModal">
        <i class="fa-solid fa-square-check"></i>
        Zatwierdź zmiany
      </button>
    </div>
  </div>
</template>
<script>
import PanelAchievementStatus from "./panel-achievement-status/PanelAchievementStatus";
import AchievementStateConfirmation from "./AchievementStateConfirmation";
import {watch, ref} from "vue";
import {changeAchievementsStates} from "@/assets/js/api/achievement";
import {getLoggedAdminId} from "@/assets/js/helpers/admin";

export default {
  emits: [
    'changed-statuses'
  ],
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
  setup(props, context) {
    const achievementActionModal = ref(null);
    const achievementListBefore = ref([]);

    watch(() => props.achievementList, (newState) => {
      achievementListBefore.value = JSON.parse(JSON.stringify(newState));
    });

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

    const changeAchievementStatusModal = () => {
      const changed = [];
      props.achievementList.forEach((achievement) => {
        const oldState = achievementListBefore.value.find((achievementOld) => {
          return achievementOld.achievement_id === achievement.achievement_id;
        });

        if (oldState && oldState.done !== achievement.done) {
          changed.push(achievement);
        }
      });


      achievementActionModal.value.setChangedAchievements(changed);
      achievementActionModal.value.toggleModal();
    };

    const cancelAction = () => {
      // console.log('cancelAction');
    };

    const executeAction = (event) => {
      const achievementData = {
        profile_id: props.profileId,
        achievements: event.achievements,
        admin_id: getLoggedAdminId()
      };
      changeAchievementsStates(achievementData).then(() => {
        // console.log(`changeAchievementsStates(${achievementData})`, results);
        context.emit('changed-statuses');
      }).catch((err) => {
        console.log(`changeAchievementsStates() err`, achievementData, err);
        cancelAction();
      });
    };

    const changedAchievementValue = (event) => {
      const changedAchievementId = event.achievement.achievement_id;
      const changedAchievementValue = event.toggler.value.getValue();

      const found = props.achievementList.filter((achievement) => achievement.achievement_id === changedAchievementId);
      if (found?.length > 0) {
        found[0].done = changedAchievementValue;
      } else {
        console.error('failed to change achievement state');
      }
      //  achievementId
    };

    return {
      achievementActionModal,
      cancelAction,
      changeAchievementStatusModal,
      changedAchievementValue,
      executeAction,
      getAchievementDivClasses
    };
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

  // SPLIT INTO SHARED DEF
  &__achievement-cta {
    display: flex;
    justify-content: flex-end;
    margin: 1rem 0;

    & > button {
      background-color: $color-red;
      color: $color-white;
      font-size: 1rem;
      line-height: 1.125rem;
    }
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


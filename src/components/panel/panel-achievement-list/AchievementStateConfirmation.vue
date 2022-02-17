<template>
  <button id="modalToggler" type="button" class="btn btn-primary hidden" data-toggle="modal"
          data-target="#confirmation"></button>
  <div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="confirmationLabel"
       aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmationLabel">Zmiana stanu osiągnięcia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cancel">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Czy na pewno chcesz zmienić stan osiągnięć?
          <div class="mt-1" v-if="changedAchievements.length > 0">
            Zmieniono osiągnięcia:
            <br>
            <template v-for="achievement in changedAchievements" :key="achievement.achievement_id">
            <span class="mr-1 achievement-changed__status">
              <span v-if="achievement?.achievement_type?.name">
                [{{ getAchievementTypeName(achievement.achievement_type.name) }}]
              </span>
              {{ !!achievement && !!achievement.number ? achievement.number : '' }}
              <i v-if="!!achievement.done" class="fas fa-check"></i>
              <i v-else class="fas fa-times"></i>
            </span>
            </template>
          </div>
          <div class="mt-2" v-else>
            Brak zmienionych osiągnięć
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cancel">Nie</button>
          <button type="button" class="btn btn-primary" @click="execute" :disabled="changedAchievements.length === 0">
            Tak
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {ref} from "vue";
import {translateAchievementType} from "@/assets/js/helpers/achievement";

export default {
  emits: [
    'cancel-action',
    'execute-action'
  ],
  setup(props, context) {
    const changedAchievements = ref([]);
    const toggler = ref(null);

    const toggleModal = () => {
      const toggleModal = document.querySelector('#modalToggler');
      if (toggleModal) {
        toggleModal.click();
      }
    };

    const setChangedAchievements = (newAchievementsStatuses) => {
      changedAchievements.value = newAchievementsStatuses;
    };

    const execute = () => {
      toggleModal();
      context.emit('execute-action', {
        achievements: changedAchievements.value,
        toggler
      });
    };

    const cancel = () => {
      context.emit('cancel-action');
    };

    const getAchievementTypeName = (typeName) => {
      return translateAchievementType(typeName);
    };

    return {cancel, changedAchievements, execute, getAchievementTypeName, toggler, toggleModal, setChangedAchievements};
  }
}
</script>
<style lang="scss" scoped>
@import "../../../assets/scss/shared";

.hidden {
  display: none;
  width: 0;
  height: 0;
}

.modal-dialog {
  color: $color-darkest;
}

.achievement-changed__status {
  @extend %achievement-status;

  & > .fas {
    font-size: 1rem;
  }
}
</style>

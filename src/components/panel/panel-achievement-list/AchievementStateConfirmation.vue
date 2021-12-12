<template>
  <button id="modalToggler" type="button" class="btn btn-primary hidden" data-toggle="modal"
          data-target="#exampleModal"></button>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Zmiana stanu osiągnięcia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cancel">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Czy na pewno chcesz zmienić stan osiągnięcia?
          <br>
          Osiągnięcie
          <span>
            {{ !!achievement && !!achievement.achievement_id ? achievement.achievement_id : '' }}
          </span>
          oznaczyć jako {{ !!achievement && !!achievement.done ? 'niewykonane' : 'wykonane' }}?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cancel">Nie</button>
          <button type="button" class="btn btn-primary" @click="execute">Tak</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
// TODO:
// make as shared component
import {ref} from "vue";

export default {
  emits: [
    'cancel-action',
    'execute-action'
  ],
  setup(props, context) {
    const achievement = ref(null);
    const toggler = ref(null);

    const toggleModal = () => {
      const toggleModal = document.querySelector('#modalToggler');
      if (toggleModal) {
        toggleModal.click();
      }
    };

    const setAchievement = (newAchievement, newTogglerRef) => {
      achievement.value = newAchievement;
      toggler.value = newTogglerRef.value;
    };

    const execute = () => {
      toggleModal();
      context.emit('execute-action', {
        achievement: achievement.value,
        toggler
      });
    };

    const cancel = () => {
      context.emit('cancel-action', toggler);
    };

    return {cancel, execute, toggler, toggleModal, setAchievement};
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
</style>

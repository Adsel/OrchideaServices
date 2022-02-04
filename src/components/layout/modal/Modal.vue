<template>
  <button :id="'customModalToggler' + randomId" type="button" class="btn btn-primary hidden" data-toggle="modal"
          :data-target="'#customModal' + randomId"></button>
  <div class="modal fade" :id="'customModal' + randomId" tabindex="-1" role="dialog"
       :aria-labelledby="'customModalLabel' + randomId"
       aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" :id="'customModalLabel' + randomId">{{ header }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="cancel" @click="cancel">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <slot></slot>
        </div>
        <div class="modal-footer">
          <template v-if="isConfirmationModal">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cancel">
              {{ labelCancel }}
            </button>
            <button type="button" class="btn btn-primary" @click="execute">
              {{ labelConfirmation }}
            </button>
          </template>
          <template v-else>
            <button type="button" class="btn btn-primary" @click="execute">
              {{ labelConfirmation }}
            </button>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {generateCustomId} from "@/assets/js/helpers/random";

export default {
  emits: [
    'cancel-action',
    'execute-action'
  ],
  props: {
    header: {
      type: String,
      required: true
    },
    isConfirmationModal: {
      type: Boolean,
      required: false,
      default: false
    },
    labelConfirmation: {
      type: String,
      required: true
    },
    labelCancel: {
      type: String,
      required: false
    },
  },
  setup(props, context) {
    const randomId = generateCustomId();

    const toggleModal = () => {
      const toggleModal = document.querySelector(`#customModalToggler${randomId}`);
      if (toggleModal) {
        toggleModal.click();
      }
    };

    const execute = () => {
      toggleModal();
      context.emit('execute-action');
    };

    const cancel = () => {
      context.emit('cancel-action');
    };

    return {cancel, execute, randomId, toggleModal};
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

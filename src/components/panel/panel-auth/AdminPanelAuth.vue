<template>
  <div class="admin-panel__login">
    <AchievementSingleFilter title="Login"
                             placeholder="Login" ref="loginInput"></AchievementSingleFilter>
    <AchievementSingleFilter title="Hasło" description="Dostęp tylko dla upoważnionych"
                             :passwordType="true"
                             placeholder="Hasło" ref="passwordInput"></AchievementSingleFilter>
    <div class="admin-panel__login-cta">
      <button class="btn" @click="login">
        <i class="fas fa-search"></i>
        Zaloguj się
      </button>
    </div>
  </div>

  <Modal ref="authModalRef" :is-confirmation-modal="false" header="Próba logowania" label-confirmation="Ok">
    {{ authModalMessage }}
  </Modal>
</template>

<script>
import AchievementSingleFilter
  from "@/components/achievements/achievement-filter/achievement-single-filter/AchievementSingleFilter";
import Modal from "@/components/layout/modal/Modal";
import {LOCAL_STORAGE_KEY_LOGGED_ADMIN} from "@/assets/js/variables/auth";
import {loginAdministrator} from "@/assets/js/api/auth";
import {ref} from "vue";

export default {
  emits: ['logged-admin'],
  components: {
    Modal,
    AchievementSingleFilter
  },
  setup(props, context) {
    const loginInput = ref('');
    const passwordInput = ref('');
    const authModalRef = ref(null);
    const authModalMessage = ref('');

    const saveAdminDataIntoLocalStorage = (adminData) => {
      localStorage.setItem(LOCAL_STORAGE_KEY_LOGGED_ADMIN, JSON.stringify(adminData));
    };

    const login = () => {
      const authData = {
        login: loginInput.value.getInputValue(),
        password: passwordInput.value.getInputValue()
      };

      authModalMessage.value = '';
      loginAdministrator(authData).then((results) => {
        // console.log(`loginAdministrator(${authData})`, results);
        if (!!results && !!results.status && !!results.admin && !!results.token) {
          const loggedAdmin = results.admin;
          saveAdminDataIntoLocalStorage(loggedAdmin)
          authModalMessage.value = 'Administrator poprawnie zalogowany!';
          context.emit('logged-admin', loggedAdmin);
        }
      }).catch((err) => {
        authModalMessage.value = 'Błąd logowania do panelu administratora!';
        console.error(`loginAdministrator(${authData}) err`, err);
        authModalRef.value.toggleModal();
      });
    };

    return {authModalRef, authModalMessage, login, loginInput, passwordInput}
  }
}
</script>
<style lang="scss" scoped>
@import "../../../assets/scss/shared";

.admin-panel {
  &__login {
    width: 400px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  &__login-cta {
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
</style>

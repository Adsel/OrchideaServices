<template>
  <Subpage :admin-side="true">
    <div class="row p-3">
      <div v-if="!loggedAdmin" class="admin-panel__login-wrapper p-3">
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
      </div>
      <template v-else>
        <div class="admin-panel__wrapper col-md-12 px-5">
          <div class="px-5 pb-1 pt-3">
          <span class="admin-panel__welcome">
            Zalogowany jako
            <span class="admin-panel__welcome-name">{{ loggedAdmin.visible_name }}</span>.
          </span>
          </div>
          <div class="admin-panel__management">
            <AchievementSingleFilter title="ID profilu gracza" description="Wprowadź identyfikator profilu gracza"
                                     placeholder="ID profilu" ref="profileIdInput"></AchievementSingleFilter>
            <div class="admin-panel__login-cta">
              <button class="btn" @click="loadAchievements">
                <i class="fas fa-search"></i>
                Pokaż osiągnięcia gracza
              </button>
            </div>
          </div>
          <div class="admin-panel__wrapper col-md-12 px-5">
            <PanelAchievementList :profile-id="enteredProfileIdInput"
                                  :achievement-list="achievements"></PanelAchievementList>
          </div>
        </div>
      </template>
    </div>
  </Subpage>
</template>
<script>
import {ref} from "vue";
import Subpage from "../layout/subpage/Subpage";
import AchievementSingleFilter
  from "../achievements/achievement-filter/achievement-single-filter/AchievementSingleFilter";
import PanelAchievementList from "./panel-achievement-list/PanelAchievementList";
import {getFilteredAchievements} from "../../assets/js/api/achievement";
import {loginAdministrator} from "@/assets/js/api/auth";

export default {
  components: {
    PanelAchievementList,
    AchievementSingleFilter,
    Subpage
  },
  setup() {
    const loggedAdmin = ref(null);
    const passwordInput = ref('');
    const loginInput = ref('');
    const profileIdInput = ref('');
    const enteredProfileIdInput = ref('');
    const achievements = ref([]);

    const login = () => {
      const authData = {
        login: loginInput.value.getInputValue(),
        password: passwordInput.value.getInputValue()
      };

      loggedAdmin.value = null;
      loginAdministrator(authData).then((results) => {
        // console.error(`loginAdministrator(${authData})`, results);

        if (!!results && !!results.status && !!results.admin && !!results.token) {
          loggedAdmin.value = results.admin;
        }
      }).catch((err) => {
        // TODO:
        // Modal
        alert('Błąd logowania do panelu administratora!');
        console.error(`loginAdministrator(${authData}) err`, err);
      });
    };

    const loadAchievements = () => {
      achievements.value = [];
      enteredProfileIdInput.value = '';
      const profileId = profileIdInput.value.getInputValue();
      const filterData = {profile_id: profileId};

      getFilteredAchievements(filterData).then((results) => {
        enteredProfileIdInput.value = profileId;
        // console.log(`getFilteredAchievements(${filterData})`, results);
        if (!!results && !!results.achievements) {
          achievements.value = results.achievements;
        }
      }).catch((err) => {
        console.log(`getFilteredAchievements(${filterData}) err`, err);
      });
    };

    return {
      achievements,
      loginInput,
      passwordInput,
      profileIdInput,
      enteredProfileIdInput,
      loggedAdmin,
      login,
      loadAchievements
    };
  }
}
</script>
<style lang="scss" scoped>
@import "../../assets/scss/shared";

%admin-panel {
  background-color: $color-dark;
  overflow-y: scroll;
  display: flex;
  padding: 0;
  margin: 0;
}

.admin-panel {
  &__login-wrapper {
    @extend %admin-panel;
    @include customScrollbarY($color-dark);

    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 40%;
    margin: auto;
  }

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

  &__wrapper {
    @extend %admin-panel;
    @include customScrollbarY($color-dark);

    display: unset;
  }

  &__management {
    width: 40%;
    margin: auto;
  }

  &__welcome {
    color: $color-ash;
    font-size: 1.125rem;
  }

  &__welcome-name {
    color: $color-yellow;
    font-weight: bold;
  }
}

.basic-filter {
  width: 100%;
}
</style>

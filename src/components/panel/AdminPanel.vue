<template>
  <Subpage :admin-side="true">
    <div class="row p-3">
<!--      <div v-if="false || enteredPassword !== PASSWORD" class="admin-panel__login-wrapper p-3">-->
      <div v-if="false" class="admin-panel__login-wrapper p-3">
        <div class="admin-panel__login">
          <AchievementSingleFilter title="Hasło do panelu" description="Dostęp tylko dla upoważnionych"
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

export default {
  components: {
    PanelAchievementList,
    AchievementSingleFilter,
    Subpage
  },
  setup() {
    // TODO:
    // replace with JWT token
    const PASSWORD = '>p@V2V<(w4Gcym!$';
    const enteredPassword = ref('');
    const passwordInput = ref('');
    const profileIdInput = ref('');
    const enteredProfileIdInput = ref('');
    const achievements = ref([]);

    const login = () => {
      enteredPassword.value = passwordInput.value.getInputValue();
      if (enteredPassword.value !== PASSWORD) {
        alert('Błędne hasło');
      }
    };

    const loadAchievements = () => {
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
      enteredPassword,
      achievements,
      passwordInput,
      profileIdInput,
      enteredProfileIdInput,
      PASSWORD,
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
}

.basic-filter {
  width: 100%;
}
</style>

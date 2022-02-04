<template>
  <Subpage :admin-side="true">
    <div class="row p-3">
      <div v-if="!loggedAdmin" class="admin-panel__login-wrapper p-3">
        <AdminPanelAuth @loggedAdmin="successfulLogin"></AdminPanelAuth>
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
            <div class="admin-panel__achievement-cta">
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
import {ref, onMounted} from "vue";
import Subpage from "../layout/subpage/Subpage";
import AdminPanelAuth from "@/components/panel/panel-auth/AdminPanelAuth";
import AchievementSingleFilter
  from "../achievements/achievement-filter/achievement-single-filter/AchievementSingleFilter";
import PanelAchievementList from "./panel-achievement-list/PanelAchievementList";
import {getFilteredAchievements} from "@/assets/js/api/achievement";
import {LOCAL_STORAGE_KEY_LOGGED_ADMIN} from "@/assets/js/variables/auth";

export default {
  components: {
    AdminPanelAuth,
    PanelAchievementList,
    AchievementSingleFilter,
    Subpage
  },
  setup() {
    const loggedAdmin = ref(null);
    const profileIdInput = ref('');
    const enteredProfileIdInput = ref('');
    const achievements = ref([]);

    onMounted(() => {
      const loggedAdminString = localStorage.getItem(LOCAL_STORAGE_KEY_LOGGED_ADMIN);
      if (loggedAdminString) {
        const loggedAdminObject = JSON.parse(loggedAdminString);
        loggedAdmin.value = loggedAdminObject;
      }
    });

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

    const successfulLogin = (admin) => {
      loggedAdmin.value = admin;
    };

    return {
      achievements,
      profileIdInput,
      enteredProfileIdInput,
      loggedAdmin,
      successfulLogin,
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

.basic-filter {
  width: 100%;
}
</style>

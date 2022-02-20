export const ACHIEVEMENT_TYPE_NAME_STARTING = 'STARTING';
export const ACHIEVEMENT_TYPE_NAME_MAIN = 'MAIN';
export const ACHIEVEMENT_TYPE_NAME_NORMAL = 'NORMAL';
export const ACHIEVEMENT_TYPE_NAME_HARD = 'HARD';
export const ACHIEVEMENT_TYPE_NAME_LABORIOUS = 'LABORIOUS';

export const ACHIEVEMENT_TYPE_LABEL_STARTING = 'Startowe';
export const ACHIEVEMENT_TYPE_LABEL_MAIN = 'Główne';
export const ACHIEVEMENT_TYPE_LABEL_NORMAL = 'Normalne';
export const ACHIEVEMENT_TYPE_LABEL_HARD = 'Trudne';
export const ACHIEVEMENT_TYPE_LABEL_LABORIOUS = 'Wymagające';

const translateAchievementType = (achievementTypeName) => {
    let translatedTitle = '';

    switch (achievementTypeName) {
        case ACHIEVEMENT_TYPE_NAME_STARTING: translatedTitle = ACHIEVEMENT_TYPE_LABEL_STARTING; break;
        case ACHIEVEMENT_TYPE_NAME_MAIN: translatedTitle = ACHIEVEMENT_TYPE_LABEL_MAIN; break;
        case ACHIEVEMENT_TYPE_NAME_NORMAL: translatedTitle = ACHIEVEMENT_TYPE_LABEL_NORMAL; break;
        case ACHIEVEMENT_TYPE_NAME_HARD: translatedTitle = ACHIEVEMENT_TYPE_LABEL_HARD; break;
        case ACHIEVEMENT_TYPE_NAME_LABORIOUS: translatedTitle = ACHIEVEMENT_TYPE_LABEL_LABORIOUS; break;
    }

    return translatedTitle;
};

const reTranslateAchievementType = (achievementTypeName) => {
    let translatedTitle = '';

    switch (achievementTypeName) {
        case ACHIEVEMENT_TYPE_LABEL_STARTING: translatedTitle = ACHIEVEMENT_TYPE_NAME_STARTING; break;
        case ACHIEVEMENT_TYPE_LABEL_MAIN: translatedTitle = ACHIEVEMENT_TYPE_NAME_MAIN; break;
        case ACHIEVEMENT_TYPE_LABEL_NORMAL: translatedTitle = ACHIEVEMENT_TYPE_NAME_NORMAL; break;
        case ACHIEVEMENT_TYPE_LABEL_HARD: translatedTitle = ACHIEVEMENT_TYPE_NAME_HARD; break;
        case ACHIEVEMENT_TYPE_LABEL_LABORIOUS: translatedTitle = ACHIEVEMENT_TYPE_NAME_LABORIOUS; break;
    }

    return translatedTitle;
};

export {translateAchievementType, reTranslateAchievementType};

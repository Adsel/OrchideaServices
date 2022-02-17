const translateAchievementType = (achievementTypeName) => {
    let translatedTitle = '';

    switch (achievementTypeName) {
        case 'STARTING': translatedTitle = 'Startowe'; break;
        case 'MAIN': translatedTitle = 'Główne'; break;
        case 'NORMAL': translatedTitle = 'Normalne'; break;
        case 'HARD': translatedTitle = 'Trudne'; break;
        case 'LABORIOUS': translatedTitle = 'Wymagające'; break;
    }

    return translatedTitle;
};

export {translateAchievementType};

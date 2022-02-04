const CUSTOM_ID_LENGTH = 6;
const CUSTOM_ID_POOL_LENGTH = 30;

const generateCustomId = () => {
    return (Math.random() + 1).toString(CUSTOM_ID_POOL_LENGTH).substring(CUSTOM_ID_LENGTH);
};

export {generateCustomId}

const countDownHelper = (countDownDate, currentTimeDate) => {
    const distance = countDownDate - currentTimeDate.getTime();
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    const daysStr = days >= 10  && days >= 0 ? days : '0' + days.toString();
    const hoursStr = hours >= 10 && hours >= 0 ? hours : '0' + hours.toString();
    const minutesStr = minutes >= 10 && minutes >= 0 ? minutes : '0' + minutes.toString();
    const secondsStr = seconds >= 10 && seconds >= 0 ? seconds : '0' + seconds.toString();

    return {
        days: daysStr,
        hours: hoursStr,
        minutes: minutesStr,
        seconds: secondsStr,
        distance
    }
}

export {countDownHelper}

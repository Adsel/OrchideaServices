<?php

// === LOTTERY ===
$router->map('GET', '/index.php/lottery/timer', function () {
    echo (new LotteryController())->getTimer();
});

$router->map('GET', '/index.php/lottery/result', function () {
    echo (new LotteryController())->getLastResult();
});

$router->map('GET', '/index.php/lottery/nicknames', function () {
    echo (new LotteryController())->getNicknames();
});

// === ACHIEVEMENTS ===
$router->map('GET', '/index.php/achievements/available', function () {
    echo (new AchievementController())->getAvailableAchievements();
});

$router->map('GET', '/index.php/achievements/player/[:key]', function (string $key) {
    echo (new AchievementController())->getPlayerAchievements($key);
});
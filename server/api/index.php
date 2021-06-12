<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../../vendor/autoload.php";
require "../lib/orm-config.php";

$router = new AltoRouter();
$router->setBasePath(getenv('API_PATH'));

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

// === MATCHING PATHS ===
$match = $router->match();

if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo 'Page 404';
}

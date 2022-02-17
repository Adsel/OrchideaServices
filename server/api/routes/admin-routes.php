<?php

// === ACHIEVEMENTS ===

$router->map('POST', '/index.php/achievements/statuses', function () {
    echo (new AchievementController())->changeAchievementsStatuses();
});

// === AUTH ===

$router->map('POST', '/index.php/auth/login', function () {
    echo (new AuthController())->loginAdministrator();
});

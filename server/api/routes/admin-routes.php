<?php

// === ACHIEVEMENTS ===

$router->map('POST', '/index.php/achievement/status', function () {
    echo (new AchievementController())->changeAchievementStatus();
});

// === AUTH ===

$router->map('POST', '/index.php/auth/login', function () {
    echo (new AuthController())->loginAdministrator();
});

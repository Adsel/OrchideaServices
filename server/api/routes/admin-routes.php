<?php

// === ACHIEVEMENTS ===

$router->map('POST', '/index.php/achievement/status', function () {
    echo (new AchievementController())->changeAchievementStatus();
});

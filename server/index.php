<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "./vendor/autoload.php";
require "./lib/env-load.php";
require "./lib/orm-config.php";

$BASE_PATH = $_ENV['API_PATH'];

$router = new AltoRouter();
$router->setBasePath($BASE_PATH);

require_once "./api/routes/user-routes.php";
require_once "./api/routes/admin-routes.php";

// === MATCHING PATHS ===
$match = $router->match();

if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo 'Page 404';
}

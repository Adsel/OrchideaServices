<?php

$REQUIRED_ENVS = [
    'DB_HOST',
    'DB_NAME',
    'DB_USER',
    'DB_PASS',
    'API_PATH',
    'NICKNAMES_FILE_PATH'
];

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$dotenv->required($REQUIRED_ENVS);

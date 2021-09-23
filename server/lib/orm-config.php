<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$CONNECTION_CONFIG = [
    "driver" => "mysql",
    "host" => $_ENV['DB_HOST'],
    "database" => $_ENV['DB_NAME'],
    "username" => $_ENV['DB_USER'],
    "password" => $_ENV['DB_PASS'],
    "charset"   => "utf8",
    "collation" => "utf8_unicode_ci",
    "prefix"    => false,
];

$capsule = new Capsule;
$capsule->addConnection($CONNECTION_CONFIG);
$capsule->setAsGlobal();
$capsule->bootEloquent();

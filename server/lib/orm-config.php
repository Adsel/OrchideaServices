<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$CONNECTION_CONFIG = [
    "driver" => "mysql",
    "host" => getenv('DB_HOST'),
    "database" => getenv('DB_NAME'),
    "username" => getenv('DB_USER'),
    "password" => getenv('DB_PASS'),
    "charset"   => "utf8",
    "collation" => "utf8_unicode_ci",
    "prefix"    => false,
];

$capsule = new Capsule;
$capsule->addConnection($CONNECTION_CONFIG);
$capsule->setAsGlobal();
$capsule->bootEloquent();

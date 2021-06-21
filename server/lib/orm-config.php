<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    "driver" => "mysql",
    "host" => getenv('DB_HOST'),
    "database" => getenv('DB_NAME'),
    "username" => getenv('DB_USER'),
    "password" => getenv('DB_PASS'),
    "charset"   => "utf8",
    "collation" => "utf8_unicode_ci",
    "prefix"    => false,
]);

// Make this Capsule instance available globally.
$capsule->setAsGlobal();

// Setup the Eloquent ORM.
$capsule->bootEloquent();
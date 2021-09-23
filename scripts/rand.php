<?php

require "../vendor/autoload.php";
require "../server/lib/env-load.php";
require "../server/lib/orm-config.php";

echo (new LotteryController())->randLottery();


<?php

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
require "../server/vendor/autoload.php";
require "../server/lib/env-load.php";
require "../server/lib/orm-config.php";

echo (new LotteryController())->randLottery();


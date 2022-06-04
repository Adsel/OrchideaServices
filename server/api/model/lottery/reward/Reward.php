<?php

namespace model\lottery\reward;

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
interface Reward
{
    /**
     * Return reward representation string
     *
     * @return string
     */
    public function getRewardDescription(): string;
}

<?php

namespace model\lottery\rewards_pool;

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
interface OutputFormat
{
    /**
     * Formatting Output to text
     *
     * @param RewardsResults $rewards
     * @return string
     */
    public function formatOutput(RewardsResults $rewards): string;
}

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
interface RewardsSortingStrategy
{
    /**
     * Sort results using specific strategy
     *
     * @param array $results
     * @return array
     */
    public function sort(array $results): array;
}

<?php

use model\lottery\rewards_pool\RewardsSortingStrategy;

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
class SortByNameDescStrategy implements RewardsSortingStrategy
{
    /**
     * @inheritDoc
     */
    public function sort(array $results): array
    {
        rsort($results);

        return $results;
    }
}

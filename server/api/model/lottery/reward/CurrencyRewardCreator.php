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
class CurrencyRewardCreator extends RewardCreator
{
    /**
     * @inheritDoc
     */
    public function factoryMethod(int $amount): Reward
    {
        return new CurrencyReward($amount);
    }
}
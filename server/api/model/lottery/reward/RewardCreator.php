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
abstract class RewardCreator
{
    /**
     * Create Reward instance
     *
     * @param int $amount
     * @return Reward
     */
    abstract public function factoryMethod(int $amount): Reward;

    /**
     * Return reward representation string
     *
     * @param int $amount
     * @return string
     */
    public function createReward(int $amount): string
    {
        return $this->factoryMethod($amount)->getRewardDescription();
    }
}

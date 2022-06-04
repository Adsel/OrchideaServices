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
class GoldReward implements Reward
{
    const GOLD_UNIT_MILLION_SHORTCUT = 'm';

    private int $amount;

    /**
     * GoldReward constructor.
     *
     * @param int $rewardAmount
     */
    public function __construct(int $rewardAmount)
    {
        $this->amount = $rewardAmount;
    }

    /**
     * @inheritDoc
     */
    public function getRewardDescription(): string
    {
        return $this->amount . self::GOLD_UNIT_MILLION_SHORTCUT;
    }
}

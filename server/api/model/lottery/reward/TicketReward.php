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
class TicketReward implements Reward
{
    const REWARD_NAME_TICKET = 'strzal';
    const REWARD_NAME_TIMES = 'x';

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
        return $this->prepareAmountString();
    }

    /**
     * Helper which prepare ticket name
     *
     * @return string
     */
    private function prepareAmountString(): string
    {
        $amountString = self::REWARD_NAME_TICKET;

        if ($this->amount <= 1) {
            return $amountString;
        }

        return $amountString . ' ' . self::REWARD_NAME_TIMES . $this->amount;
    }
}

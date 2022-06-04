<?php

namespace model;

use model\lottery\reward\CurrencyRewardCreator;
use model\lottery\reward\GoldRewardCreator;
use model\lottery\reward\TicketRewardCreator;
use model\lottery\rewards_pool\RewardsPool;

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
class Lottery
{
    const REWARD_NAME_EMPTY = 'pusto';
    const TICKETS_COUNT = 100;

    const CONFIGURATION_PREFIX_TICKET = 'ticket';
    const CONFIGURATION_PREFIX_GOLD = 'gold';
    const CONFIGURATION_PREFIX_CURRENCY = 'currency';

    const CONFIGURATION = [
        self::CONFIGURATION_PREFIX_TICKET . '_1' => 2,
        self::CONFIGURATION_PREFIX_TICKET . '_2' => 5,
        self::CONFIGURATION_PREFIX_GOLD . '_200' => 1,
        self::CONFIGURATION_PREFIX_GOLD . '_125' => 2,
        self::CONFIGURATION_PREFIX_GOLD . '_75' => 4,
        self::CONFIGURATION_PREFIX_GOLD . '_25' => 6,
        self::CONFIGURATION_PREFIX_CURRENCY . '_80' => 2,
        self::CONFIGURATION_PREFIX_CURRENCY . '_40' => 4,
        self::CONFIGURATION_PREFIX_CURRENCY . '_20' => 6,
        self::CONFIGURATION_PREFIX_CURRENCY . '_10' => 8,
    ];

    public static ?RewardsPool $rewardsInPool = null;

    /**
     * Init all rewards
     *
     * @return void
     */
    public static function prepareRewardPool(): void
    {
        self::createRewards();
    }

    /**
     * Create single reward instance
     *
     * @param string $rewardType
     * @param int $amount
     * @return string
     */
    private static function createRewardInstance(string $rewardType, int $amount): string
    {
        if ($rewardType === self::CONFIGURATION_PREFIX_TICKET) {
            $reward = new TicketRewardCreator();
        } else if ($rewardType === self::CONFIGURATION_PREFIX_GOLD) {
            $reward = new GoldRewardCreator();
        } else {
            $reward = new CurrencyRewardCreator();
        }

        return $reward->createReward($amount);
    }

    /**
     * Create rewards depends on lottery configuration (lottery pool)
     *
     * @return void
     */
    private static function createRewards(): void
    {
        $tempArray = [];

        foreach (self::CONFIGURATION as $rewardKey => $count) {
            $rewardData = explode('_', $rewardKey);
            for ($i = 0; $i < $count; $i++) {
                $tempArray[] = self::createRewardInstance($rewardData[0], $rewardData[1]);
            }
        }

        self::$rewardsInPool = new RewardsPool($tempArray);
    }
}

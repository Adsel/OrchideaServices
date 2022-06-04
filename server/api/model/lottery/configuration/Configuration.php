<?php

use model\Lottery;

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
class Configuration
{
    private array $rewards;
    private int $ticketCount;

    /**
     * Configuration constructor with initialization.
     */
    public function __construct() {
        $this->ticketCount = 100;
        $this->rewards = [
            Lottery::CONFIGURATION_PREFIX_TICKET . '_1' => 2,
            Lottery::CONFIGURATION_PREFIX_TICKET . '_2' => 5,
            Lottery::CONFIGURATION_PREFIX_GOLD . '_200' => 1,
            Lottery::CONFIGURATION_PREFIX_GOLD . '_125' => 2,
            Lottery::CONFIGURATION_PREFIX_GOLD . '_75' => 4,
            Lottery::CONFIGURATION_PREFIX_GOLD . '_25' => 6,
            Lottery::CONFIGURATION_PREFIX_CURRENCY . '_80' => 2,
            Lottery::CONFIGURATION_PREFIX_CURRENCY . '_40' => 4,
            Lottery::CONFIGURATION_PREFIX_CURRENCY . '_20' => 6,
            Lottery::CONFIGURATION_PREFIX_CURRENCY . '_10' => 8,
        ];
    }

    /**
     * Return rewards pool
     *
     * @return array
     */
    public function getRewards(): array
    {
        return $this->rewards;
    }

    /**
     * Return ticket count
     *
     * @return int
     */
    public function getTicketCount(): int
    {
        return $this->ticketCount;
    }
}

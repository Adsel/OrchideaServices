<?php

namespace model\lottery\rewards_pool;

use Carbon\Carbon;

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
class RewardsResults
{
    private array $rewardsResults;
    private string $generated_at;

    /**
     * RewardsPool constructor.
     *
     * @param array $rewards
     */
    public function __construct(array $rewards)
    {
        $this->setRewardsResults($rewards);
    }

    /**
     * Clone using prototype pattern
     *
     * @return void
     */
    public function __clone()
    {
        $this->rewardsResults = [...$this->rewardsResults];
        $this->generated_at = Carbon::now();
    }

    /**
     * Set actual rewards
     *
     * @param array $rewards
     * @return void
     */
    public function setRewardsResults(array $rewards): void
    {
        $this->rewardsResults = $rewards;
        $this->generated_at = Carbon::now();
    }

    /**
     * Get actual rewards from rewards' pool
     *
     * @return array
     */
    public function getResults(): array
    {
        return $this->rewardsResults;
    }

    /**
     * Get timestamp when pool was generated
     *
     * @return string
     */
    public function getGeneratedAt(): string
    {
        return $this->generated_at;
    }
}

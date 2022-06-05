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
class RewardsPool
{
    private array $rewardsInPool;
    private string $generated_at;
    private ?RewardsSortingStrategy $sortingStrategy;

    /**
     * RewardsPool constructor.
     *
     * @param array $rewards
     */
    public function __construct(array $rewards)
    {
        $this->setRewardsInPool($rewards);
    }

    /**
     * Clone using prototype pattern
     *
     * @return void
     */
    public function __clone()
    {
        $this->rewardsInPool = [...$this->rewardsInPool];
        $this->generated_at = Carbon::now();
    }

    /**
     * Set actual rewards
     *
     * @param array $rewards
     * @return void
     */
    public function setRewardsInPool(array $rewards): void
    {
        $this->rewardsInPool = $rewards;
        $this->generated_at = Carbon::now();
    }

    /**
     * Get actual rewards from rewards' pool
     *
     * @return array
     */
    public function getRewardsFromPool(): array
    {
        $rewards = $this->rewardsInPool;

        if (isset($this->sortingStrategy)) {
            return $this->sortingStrategy->sort($rewards);
        }

        return $rewards;
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

    /**
     * Set specific sorting strategy
     *
     * @param RewardsSortingStrategy $strategy
     * @return void
     */
    public function setSortingStrategy(RewardsSortingStrategy $strategy): void
    {
        $this->sortingStrategy = $strategy;
    }
}

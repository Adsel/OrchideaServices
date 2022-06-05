<?php

namespace model\lottery\rewards_pool;

use Carbon\Carbon;
use SplObjectStorage;
use SplObserver;
use SplSubject;

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
class RewardsResults implements SplSubject
{
    private SplObjectStorage $observers;
    private array $rewardsResults;
    private string $generated_at;

    /**
     * RewardsPool constructor.
     *
     * @param array $rewards
     */
    public function __construct(array $rewards)
    {
        $this->observers = new SplObjectStorage();
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

    /**
     * Attach observer
     *
     * @param SplObserver $observer
     * @return void
     */
    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    /**
     * Detach observer
     *
     * @param SplObserver $observer
     * @return void
     */
    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    /**
     * Trigger event
     *
     * @return void
     */
    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * Send email notification
     *
     * @return void
     */
    public function sendResultsNotification(): void {
        $this->notify();
    }
}

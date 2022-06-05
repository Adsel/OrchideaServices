<?php

namespace model\lottery\rewards_pool;

/**
 * MarcinRadwan OrchideaServices
 *
 * @copyright Copyright (c) 2022 Marcin Radwan. All rights reserved.
 * @author    marcin.radwan
 *
 * @package   MarcinRadwan_OrchideaServices
 */
class TextFormat implements OutputFormat
{
    /**
     * @inheritDoc
     */
    public function formatOutput(RewardsResults $rewards): string
    {
        $output = $rewards->getGeneratedAt();

        foreach ($rewards->getResults() as $index => $reward) {
            if ($index !== 0) {
                $output .= ',';
            }

            $output .= $reward;
        }

        return $output;
    }
}
